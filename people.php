<?php
require_once('load.php');
include('header.php');
include('footer.php');
//start_session;
if(empty($_SESSION))
{  header("Location: index.php");}
$errors = array();
$sent = false;
$days=30;
$secondsperday=86400;
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(mysqli_connect_errno()){
    die("connection failed: "
        . mysqli_connect_error()
        . " (" . mysqli_connect_errno()
        . ")");}
$result = mysqli_query($connection, "SELECT * from users");
// Verify session
if ( $login->verify_session() ) {
    $user = $login->user;
}

?>
<div class="container">
<h1>USER LIST</h1>
<h6>Click a User# to Modify</h6>
<div class="table-responsive userstuff">
<table class="table table-borderless">
<tr style="padding-bottom: 20px; background: #007bff; color: white;">
<th>User Number</th>
<th>User Name</th>
<th>Employee Name</th>
<th>Email</th>
<th>Access Level</th>
</tr>
  <?php
while($row = mysqli_fetch_array($result))
{
echo "<tr>"; 
echo "<td>" . $row['ID'] . "</td>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['access'] . "</td>";
echo "</tr>";
}
?>
</table>
  </div>

<?php
if ( ! empty( $_GET ) ) {
  $_SESSION['rownum'] = $_GET[ 'id']; 
$rowid = ($_GET['id']);
 
//   print_r($_POST);
$newresult = mysqli_query($connection, "SELECT * from users where id = $rowid LIMIT 1");
$staffrow = mysqli_fetch_array($newresult);
 
} ?>
  <br>
  <div class="row">
    

    
<div class="col-md-9">
   </div>
    <div class="col-md-3">
      <form action="" method="post" class="userstuff" style="display: none;">
        <div class="form-group">

          <label for="dbid"> Enter an Employee# to modify:</label>
          <input type="number" name="id" class="form-control" id="id" <?php if ( ! empty( $_POST ) ) {if (false== $staffrow) {echo "placeholder=\"record not found\"";}} ?>required>
        </div>
        <div class="form-group">
          <input type="submit" class="form-control btn btn-primary" id="sub">
        </div>
      </form>
       </div>
  </div>
</div>

</div>

  <?php mysqli_close($connection); ?>