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

  return array( 'status' => 1 );
}

// Validate field data
function validate_data( $post ) {
  // Globalize the whitelist
  global $userwhitelist;

  // Whitelist data
  foreach ( $userwhitelist as $key ) {
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
  global $usertable;
 
  // Connect to database
  $conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
$person = ($_POST['rowid']);
  // Check database connection
  if ( $conn->connect_error ) {
       echo 'connect error';
    return false;
  } else {
      $name =     $post['name'];
      $username = $post['username'];
      $email =    $post['email'];
      $password = password_hash($post['password'], PASSWORD_DEFAULT);

 // update prepared statement   
  $sql = "UPDATE users SET name = ?, username = ?, email = ?, password=? where id=$person";
  if ($stmt = $conn->prepare($sql)) {
  $stmt->bind_param( "ssss", $name, $username, $email, $password); 
  $stmt->execute();
      
      if ( ! $stmt->execute() ) {
        return false;
      }
  } else {
      // For debugging purposes use: var_dump($mysqli->error); exit;
      var_dump($conn->error); exit;
      return false;
    }
  }

  return true;
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

// Esacpe output 
function _e( $string ) {
  return htmlentities( $string, ENT_QUOTES, 'UTF-8', false );
}
