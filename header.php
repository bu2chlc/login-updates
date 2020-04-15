<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="ccpd.css">
  <title>Login updates</title>
  <link rel="icon" type="image/png" href="favicon.ico">
 
</head>

<body>

<?php
date_default_timezone_set('America/Los_Angeles');

// Verify session
if ( $login->verify_session() ) {
    $user = $login->user;
  
}

$user = $login->user;
  if(! empty($_SESSION)){     

 echo'<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
           <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Normal User Stuff Here
        </a>
';
       
     if ($user->access=='admin'){
        echo'   <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Admin Stuff Goes in Here
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="people.php">Manage STAFF</a>';}
         echo'<li class="nav-item">
              <a class="nav-link" href="profile.php">My Profile</a>
            </li>
    <li class="nav-item">
              <a class="nav-link" href="logout.php">LOGOUT</a>
            </li>
      </div>
          </nav>';
  
  }
echo '<p style="text-align:center">';
if(! empty($_SESSION)){
echo"<br>";
echo"<br>";
echo"<br>";
echo "LOGIN: ". $user->username . ",  level: ". strtoupper($user->access);
echo ", Last Login: " . $user->last_login;
echo "</p>";}  


?>
    
   