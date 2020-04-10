<?php
require_once('load.php');
require_once( 'narcanfunctions.php');
include('header.php');
include('footer.php');
//start_session;
if(empty($_SESSION))
{  header("Location: index.php");}
$errors = array();
$sent = false;
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(mysqli_connect_errno()){
    die("connection failed: "
        . mysqli_connect_error()
        . " (" . mysqli_connect_errno()
        . ")");}
// how many days ahead to look
$days= ($user->outlookdays * 86400);
// todays date
$rawdate = (strtotime(date("Y/m/d")));
// ending date
$to_date = "'".date('Y/m/d', ($rawdate + $days))."'";
$people = "SELECT * FROM users WHERE aedcprexp between 0000-00-00 and $to_date";
$people30day = mysqli_query($connection, $people);
$result = mysqli_query($connection, "SELECT * from equipment WHERE devexpdate between 0000-00-00 and $to_date");
// Verify session
if ( $login->verify_session() ) {
    $user = $login->user;
}
?>

  <h1>
    Events in the next <?php echo $user->outlookdays; ?> days
  </h1>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <br>
        <br>
        <br>
        <br>
        <br>
        <h3>
          STAFF EXPIRATIONS
        </h3>
      </div>
      <div class="col-md-10">
         <h6>Click a User# to Modify</h6>
        <div class="table-responsive dashboard">
          <table class="table-sm">
            <tr style="padding-bottom: 20px; background: #007bff; color: white;">
              <th >User Number</th>
              <th>User Name</th>
              <th>Employee Name</th>
              <th>Email</th>
              <th>AED-CPR Expiration</th>
              <th>Access Level</th>
            </tr>
            <?php
while($row = mysqli_fetch_array($people30day))
{
 echo "<tr"; 
 if ($row['aedcprexp']=='0000-00-00') {echo " class=\"noexp\""; }
 else if(time() > strtotime($row['aedcprexp'])) {echo " class=\"expired\" "; }
else if(time()+2592000 < strtotime($row['aedcprexp'])) {echo " class=\"morethan30\" "; } 
else if(time()+2592000 > strtotime($row['aedcprexp'])) {echo " class=\"lessthan30\" "; }
echo ">";
  ?>
  <td><a class="hrefid" href="people.php?id=<?php echo $row['ID'] ?>"> <?php echo $row['ID'] . "</a></td>";
// echo "<td>" . $row['ID'] . "</td>";
 
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row["aedcprexp"] . "</td>";
echo "<td>" . $row['access'] . "</td>";
echo "</tr>";
}
?>
          </table>
        </div>
      </div>
    </div>
    <br>
    <br>
    
    <div class="row">
      <div class="col-md-2">
        <br>
        <br>
        <br>
        <br>
         <h3>
          EQUIPMENT EXPIRATIONS
        </h3>
      </div>
    <div class="col-md-10">
   <div class="table-responsive dashboard">
 <table class="table-sm">
<thead class="">
 <tr style="padding-bottom: 20px; background: #007bff; color: white;">
<th>ID</th>
<th>Device Type</th>
<th>Vendor</th>
<th>Serial#</th>
<th>Device EXP date</th>
<th>Adult pad date</th>
<th>Ped pad date</th>
<th>Battery EXP date</th>
<th>Location</th>
 </tr>
  </thead>
   <tbody class="scrollContent">
  <?php

while($equipmentrow = mysqli_fetch_array($result))
{
echo "<tr>"; ?>
<td><a class="hrefid" href="equipment.php?id=<?php echo $equipmentrow['id'] ?>"> <?php echo $equipmentrow['id'] . "</a></td>";
// echo "<td>" . $equipmentrow['id']             . "</td>";
echo "<td>" . $equipmentrow['devtype']        . "</td>";
echo "<td>" . $equipmentrow['vendor']         . "</td>";
echo "<td>" . $equipmentrow['serialnum']      . "</td>";
echo "<td";
if ($equipmentrow['devexpdate']=='0000-00-00') {echo " class=\"noexp\""; }
else if(time() > strtotime($equipmentrow['devexpdate'])) {echo " class=\"expired\" "; }
else if(time()+2592000 < strtotime($equipmentrow['devexpdate'])) {echo " class=\"morethan30\" "; } 
else if(time()+2592000 > strtotime($equipmentrow['devexpdate'])) {echo " class=\"lessthan30\" "; }
echo ">" . $equipmentrow['devexpdate']     . "</td>";
  
echo "<td";
if ($equipmentrow['adultpadexpdate']=='0000-00-00') {echo " class=\"noexp\""; }
else if(time() > strtotime($equipmentrow['adultpadexpdate'])) {echo " class=\"expired\" "; }
else if(time()+2592000 < strtotime($equipmentrow['adultpadexpdate'])) {echo " class=\"morethan30\" "; } 
else if(time()+2592000 > strtotime($equipmentrow['adultpadexpdate'])) {echo " class=\"lessthan30\" "; }
echo ">" . $equipmentrow['adultpadexpdate']     . "</td>";
  
echo "<td";
if ($equipmentrow['pedpadexpdate']=='0000-00-00') {echo " class=\"noexp\""; }
else if(time() > strtotime($equipmentrow['pedpadexpdate'])) {echo " class=\"expired\" "; }
else if(time()+2592000 < strtotime($equipmentrow['pedpadexpdate'])) {echo " class=\"morethan30\" "; } 
else if(time()+2592000 > strtotime($equipmentrow['pedpadexpdate'])) {echo " class=\"lessthan30\" "; }
echo ">" . $equipmentrow['pedpadexpdate'] . "</td>";

echo "<td";
if ($equipmentrow['battexpdate']=='0000-00-00') {echo " class=\"noexp\""; }
else if(time() > strtotime($equipmentrow['battexpdate'])) {echo " class=\"expired\" "; }
else if(time()+2592000 < strtotime($equipmentrow['battexpdate'])) {echo " class=\"morethan30\" "; } 
else if(time()+2592000 > strtotime($equipmentrow['battexpdate'])) {echo " class=\"lessthan30\" "; }
echo ">" . $equipmentrow['battexpdate']     . "</td>";
  
echo "<td>" . $equipmentrow['location']      . "</td>";
echo "</tr>";
}
?>
  </tbody>
        </table>
      </div>
    </div>
  </div>
    <div class="row" style="padding-top:50px;">
      <div class="col-md-2" >
        <br>
        <br>
        <br>
        <br>
         <h3>
          RANGE QUALS
        </h3>
      </div>
      <div class="col-md-10">
         <div class="table-responsive dashboard">
 <table class="table-sm">
   <h3>No info</h3>
           </table>
      </div>
    </div>
  </div>