<?php 
include('header.php'); 
// start_session;
if(empty($_SESSION))
{
  header("Location: index.php");
}
?>

<?php include('footer.php'); ?>