<?php

// Show errors for debugging. Remove this for production
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
  global $table;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  // Connect to database
  $mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

  // Check database connection
  if ( $mysqli->connect_error ) {
       echo 'connect error';
    return false;
  } else {
    
    if ( $stmt = $mysqli->prepare( "INSERT INTO $table ( rimsnum, incdate, timedispatched, timeonscene, patientname, address, incaddress, patientdob, gender, witnesscollapse, cpradminbefore, timeoffirstshock, numofshocks, regainpulse, loctype, aedrestocked, empname, comments, downtime, emtmedicarrivaltime, firstresponderwitness, whostartedcpr, aedequipmentnumber ) VALUES ( ?, ?, ?, ?, ?, ?, ? ,? ,? ,?, ? ,? ,? ,? ,? ,? ,? ,? ,? ,?, ?, ?, ?)" ) ) {
      $stmt->bind_param( "isssssssssssisssssissss", $rimsnum, $incdate, $timedispatched, $timeonscene, $patientname, $address, $incaddress, $patientdob, $gender, $witnesscollapse, $cpradminbefore, $timeoffirstshock, $numofshocks, $regainpulse, $loctype, $aedrestocked, $empname, $comments, $downtime, $emtmedicarrivaltime, $firstresponderwitness, $whostartedcpr, $aedequipmentnumber );


      $rimsnum = $post['rimsnum'];
      $incdate = $post['incdate'];
      $timedispatched = $post['timedispatched'];
      $timeonscene = $post['timeonscene'];
      $patientname = $post['patientname'];
      $address = $post['address'];
      $incaddress = $post['incaddress'];
      $patientdob = $post['patientdob'];
      $gender = $post['gender'];
      $witnesscollapse = $post['witnesscollapse'];
      $cpradminbefore = $post['cpradminbefore'];
      $timeoffirstshock = $post['timeoffirstshock'];
      $numofshocks = $post['numofshocks'];
      $regainpulse = $post['regainpulse'];
      $loctype = $post['loctype'];
      $aedrestocked = $post['aedrestocked'];
      $empname = $post['empname'];
      $comments = $post['comments'];
      $downtime = $post['downtime'];
      $emtmedicarrivaltime = $post['emtmedicarrivaltime'];
      $firstresponderwitness = $post['firstresponderwitness'];
      $whostartedcpr = $post['whostartedcpr'];
      $aedequipmentnumber = $post['aedequipmentnumber'];
      
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
$msg = "AED Usage has been reported by " . $post['empname'];

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
$headers = "From: form@something.com" . "\r\n";
// send email
return mail("user@abc.com","form sent",$msg,$headers);
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




