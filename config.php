<?php
// Default timezone
date_default_timezone_set('America/Los_Angeles');

// Database details
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );
define( 'DB_NAME', 'testdb' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8');
define( 'PORT', 3306);
define( 'ABS_URL', 'http://localhost/secure/' );
// when resetting passwords, the emails will appear to come from this account:
define( 'ADMIN_NAME', 'admin user' );
define( 'ADMIN_EMAIL', 'logins@localhost' );
$user_auth='userpass';
$admin_auth='adminpass';

/* ------------------------------------------------------------------
   STUFF YOU NEED TO CHANGE FOR YOUR SPECIFIC FORM
--------------------------------------------------------------------*/

// Set the email address usage notifcations will be sent to
$regwhitelist=  array('name', 'email', 'username', 'password');
$userwhitelist= array('name', 'email', 'username', 'password');
$staffwhitelist=array('name', 'email', 'username');
// Set the subject line for email messages
$subject = 'Login System';

// Table name
$usertable = 'users';
