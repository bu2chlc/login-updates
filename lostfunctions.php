<?php

// Show errors for debugging. Remove this for production
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Require config file
require_once( 'config.php' );
// Process the form data
function process_form($post) {
   // Validate data
  $validation = validate_data( $post );

  if ( ! $validation['status'] ) {
    return array( 'status' => 0, 'errors' => $validation['data'] );
  }
  // Use validated data
  $data = $validation['data'];

  // Process database actions
  if ( ! process_database( $data ) ) {
        return array( 'status' => 0, 'message' => 'Unable to process database request' );
  }
  // Process email
  if ( ! process_email( $data ) ) {
    return array( 'status' => 0, 'message' => 'Unable to send the email' );
  }
  return array( 'status' => 1 );
}
//Validate math
function validate_math( $value, $test ) {
  if ( $value === $test ) {
    return true;
  }

  return false;
}

// Validate email address
function validate_email( $email ) {
  if ( ! empty( $email ) && filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
    return true;
  }

  return false;
}

// Validate field data
function validate_data( $post ) {
  // Globalize the whitelist
  global $lostwhitelist;

  // Whitelist data
  foreach ( $lostwhitelist as $key ) {
    $fields[$key] = $post[$key];
  }

  // Validate data
  $errors = array();

  // Check for errors
  if ( empty( $errors ) ) {
    return array( 'status' => 1, 'data' => $fields );
  } else {
    return array( 'status' => 0, 'data' => $errors );
  }
}

// Process database actions
function process_database( $post ) {
  global $losttable;

  // Connect to database
  $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

  // Check database connection
  if ( $mysqli->connect_error ) {
       echo 'connect error';
    return false;
  } else {
    
    if ( $stmt = $mysqli->prepare( "INSERT INTO $losttable ( lost_destroyed, numofdoses, date, description, empname ) VALUES ( ? ,?, ?, ?, ?)" ) ) {
      $stmt->bind_param( "sisss", $lost_destroyed, $numofdoses, $date, $description, $empname );


      $lost_destroyed = $post['lost_destroyed'];
      $numofdoses = $post['numofdoses'];
      $date = $post['date'];
      $description = $post['description'];
      $empname = $post['empname'];

      
      if ( ! $stmt->execute() ) {
        return false;
      }
    } else {
      // For debugging purposes use: var_dump($mysqli->error); exit;
      var_dump($mysqli->error); exit;
      return false;
    }
  }

  return true;
}

// Check and process - LEAVE COMMENTED
function process_email( $post ) {

// the message
$msg = "Naloxone has been reported lost or destroyed";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
$headers = "From: naloxone@californiacitypd.org" . "\r\n";
// send email
return mail("scott@interonusa.com","Naloxone Lost/Destroyed",$msg,$headers);
}

// Validate input - LEAVE COMMENTED
function validate_input( $input_name ) {
  global $sent;

  if ( empty( $_POST ) ) {
    return '';
  }

  if ( $sent ) {
    return '';
  }

  return _e( $_POST[$input_name] );
}

// Esacpe output - LEAVE COMMENTED
function _e( $string ) {
  return htmlentities( $string, ENT_QUOTES, 'UTF-8', false );
}




