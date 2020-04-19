<?php include('header.php'); ?>
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        
      </div>
      <div class="col-md-6">
         
    <form align=center action="index.php" method="post">
       
        <?php if ( isset( $login_status ) && false == $login_status ) : ?>
        <div class="error">
                    <p>Your username and password are incorrect. Try again.</p>
        </div>
        <?php endif; ?>
      <div class="form-group">
         <h1 class="text-center">Login</h1>
        <input type="text" class="form-control" name="username" placeholder="Enter username" REQUIRED AUTOFOCUS>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Enter password">
      </div>
      <div class="form-group">
        <input type="submit" class="form-control btn btn-primary" value="Submit">
      </div>
    </form>
        
  <br>
          <br>
          <br>
          <br>
        <a class="btn btn-primary btn-block" href="register.php" role="button">Register</a>
          <a class="btn btn-success btn-block" href="index.php" role="button">Login here</a>
          <a class="btn btn-warning btn-block" href="lostpassword.php" role="button">Reset Password</a>
      </div>
      <div class="col-md-3">
      </div>
    </div>
</div>
</div>
<?php include('footer.php'); ?>