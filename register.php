<?php 
require_once('config.php');
require_once('includes/class-db.php');
require_once('includes/class-login.php');
include('header.php');
include('footer.php');
// Handle registration
if($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $register_status = $login->register($_POST);
}
$sent=false;
?>
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <form action="" method="post">
          <h1 class="text-center">Register</h1>
          <?php if ( isset( $register_status ) ) : ?>
        <?php ($register_status['status'] == true ? $class = 'success' : $class = 'error'); ?>
        <div class="message <?php echo $class; ?>">
            <p><?php echo $register_status['message']; ?></p>
        </div>
        <?php endif; ?>
          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Enter your PD email address" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Enter username" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="firstpassword" placeholder="Enter password" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="RE-Enter password" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="human" placeholder="Secret Pre-Shared Password" required>
          </div>
          <input type="submit" class="form-control btn btn-primary" value="Submit">
          <br>
          <br>
          <br>
          <br>
          <a class="btn btn-success btn-block" href="index.php" role="button">Login here</a>
          <a class="btn btn-warning btn-block" href="lostpassword.php" role="button">Reset Password</a>
        </form>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
</div>
