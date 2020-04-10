<?php
require_once('load.php');
include('header.php');
include('footer.php');
//start_session;
if(empty($_SESSION))
{  header("Location: index.php");}
$errors = array();
try{
$connection = new PDO("mysql:host=localhost;dbname=testdb", DB_USER, DB_PASS);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = "SELECT * from users";
$result =  $connection->query($query);
}
catch (PDOException $e) {
  echo $e->getMessage();
}

// Verify session
if ( $login->verify_session() ) {
    $user = $login->user;
}
?>
<div class="container">
  <h1 class="text-center">USER LIST</h1>
<div class="table-responsive userstuff">
  <table class="table table-borderless">
    <tr style="padding-bottom: 20px; background: #007bff; color: white;">
      <th>User Number</th>
      <th>User Name</th>
      <th>Employee Name</th>
      <th>Email</th>
      <th>Access Level</th>
      <th>Last Login</th>
    </tr>
<?php
try{
  while($row = $result->fetch(PDO::FETCH_ASSOC))
  {
  echo "<tr>"; 
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['username'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['access'] . "</td>";
  echo "<td>" . $row['last_login'] . "</td>";
  echo "</tr>";
  }
}
catch (PDOException $e) {
  echo "there was an error";
  echo $e->getMessage();
}
?>
  </table>
</div>
  <br>
</div>
<?php include('footer.php'); ?>