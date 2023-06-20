<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page or any other appropriate action
  header("Location: login.php");
  exit();
}

// Perform any logout actions here
// For example, you can destroy the session and unset session variables
session_destroy();
unset($_SESSION['user_id']);

// Redirect to the login page or any other appropriate action after logout
header("Location: login.php");
exit();
?>
