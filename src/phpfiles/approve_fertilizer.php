<?php
include "conn.php";
include "messages.php";

// Get the application ID and date delivered from the AJAX request
$applicationId = $_POST['id'];
$dateDelivered = $_POST['date_delivered'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE fertilizer SET delivered='Yes', date_delivered='$dateDelivered' WHERE id='$applicationId'";

if ($conn->query($sql) === TRUE) {
    // Redirect to fertilizer_admin.php on success
    
    header("Location: fertilizer_admin.php");
    exit();
} else {
    // Return an error response
    $response = array('success' => false);
    
}

$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
