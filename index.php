<?php
require_once('load.php');

// Handle logins
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_status = $login->verify_login($_POST);
    echo $login_status;
}

// Verify session
if ( $login->verify_session() ) {
     $user = $login->user;
    
    include( 'home.php' );
} else {
    include( 'login.php' );
}
if(! empty($_SESSION)){
  echo"<div class=\"container\">
  
  <h3 style=\"text-align:center;\">
    click on a menu item above
  </h3>
</div>";}
?>


