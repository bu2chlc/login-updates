<?php
require_once('load.php');
require_once( 'profilefunctions.php');
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
// Verify session
if ( $login->verify_session() ) {
    $user = $login->user;
}
// Check for form submission
if ( ! empty( $_POST ) ) {
	// Process the form
	$process = process_form( $_POST );
	// Check for errors
	if ( ! empty( $process['message'] ) ) {
		$errors[] = $process['message'];
	} else if ( ! empty( $process['errors'] ) ) {
		$errors = $process['errors'];
	} else {
		$sent = true;
	}
}
?>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <h3>My Profile</h3>
         <?php if ( ! empty( $errors ) ) : ?>
    <div class="errors">
      <p class="bg-danger">
        <?php echo implode( '.</p><p class="bg-danger">', $errors ); ?>.</p>
    </div>
    <?php elseif ( $sent ) : ?>
    <div class="success">
      <p class="bg-success">Your profile was updated.</p>
    </div>
    <?php endif; ?>
        <form action="" method="post" class="profile">
          
          <div class="form-group">
            <label for="name">Employee Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo ($user->name); ?>" id="name">
          </div>
          <div class="form-group">
            <label for="username">User Name</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo $user->username; ?>">
          </div>
          <div class="form-group">
            <label for="password">PASSWORD: (can be new or existing</label>
            <input type="password" class="form-control" name="password" value="" id="password" required>
          </div>
          <div class="form-group">
            <label for="address">email Address:</label>
            <input type="text" class="form-control" name="email" value="<?php echo ($user->email); ?>">
          </div>
 <div>
            <input type="hidden" id="rowid" name="rowid" value="<?php echo $user->ID; ?>">
          </div>
          <div class="form-group">
            <button class="btn-block btn-primary" type="submit" value="Submit">Update</button>
         </div>
        </form>
      </div>
    </div>
  </div>