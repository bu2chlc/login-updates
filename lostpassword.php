<?php 
require_once('load.php'); 

// Handle registration
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $login->lost_password($_POST);
}
?>

<?php include('header.php'); ?>
<div class="container">
    <h1 class="text-center">Lost Password</h1>
  <div class="row">
    <div class="col-md-3">
      
    </div>
    <div class="col-md-6">
       <form action="" method="post" class="profile">
        <?php if ( isset( $status ) ) : ?>
        <?php ($status['status'] == true ? $class = 'success' : $class = 'error'); ?>
        <div class="message <?php echo $class; ?>">
            <p><?php echo $status['message']; ?></p>
        </div>
        <?php endif; ?>
        <input type="text" class="text form-control" name="email" placeholder="Enter your PD email address" required>
        <input type="submit" class="form-control btn btn-primary" value="Submit">
         <br>
         <br>
         <a class="btn btn-success btn-block" href="index.php" role="button">Login here</a>
    </form>
    </div>
    <div class="col-md-3">
      
    </div>
  </div>

   
             
</div>
<?php include('footer.php'); ?>