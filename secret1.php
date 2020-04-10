<?php
// Show errors for debugging. Remove this for production
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require config file
require_once( 'config.php' );

// Process the form data
function process_form($post) {
  // Validate the math check
  if ( ! validate_math( $post['human'], 7 ) ) {
    return array( 'status' => 0, 'message' => 'Your math is suspect' );
  }

  // Validate email
  if ( ! validate_email( $post['email'] ) ) {
    return array( 'status' => 0, 'message' => 'That is not a valid email address' );
  }

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

// Validate math
function validate_math( $value, $test ) {
  if ( intval( $value ) == $test ) {
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
  global $whitelist;

  // Whitelist data
  foreach ( $whitelist as $key ) {
    $fields[$key] = $post[$key];
  }

  // Validate data
  $errors = array();

  foreach ( $fields as $field => $data ) {
    if ( empty( $data ) ) {
      $errors[] = 'Please enter your ' . $field;
    }
  }

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

  // Connect to database
  $mysqli = new mysqli( DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );

  // Check database connection
  if ( $mysqli->connect_error ) {
    return false;
  } else {
    if ( $stmt = $mysqli->prepare( "INSERT INTO $table ( name, email, message ) VALUES ( ?, ?, ? )" ) ) {
      $stmt->bind_param( "sss", $name, $email, $message );

      $name = $post['name'];
      $email = $post['email'];
      $message = $post['message'];

      if ( ! $stmt->execute() ) {
        return false;
      }
    } else {
      // For debugging purposes use: var_dump($mysqli->error); exit;
      return false;
    }
  }

  return true;
}

// Check and process
function process_email( $post ) {
  global $email_address, $subject;

  // Set headers
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= sprintf( 'From: %s <%s>', $post['name'], $post['email'] );

  // Send the email
  return mail( $email_address, $subject, $post['message'], $headers );
}

// Validate input
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

// Esacpe output
function _e( $string ) {
  return htmlentities( $string, ENT_QUOTES, 'UTF-8', false );
}
