<?php
include "conn.php";
include "messages.php";

// Get the rate per 100kgs from the form
$ratePerKgs = $_POST['rate_per_kgs'];

// Insert the rate into the fertilizer_rate table
$sql = "INSERT INTO fertilizer_rate (rate_per_kgs) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("d", $ratePerKgs);

if ($stmt->execute()) {
    // Rate saved successfully
    set_message('Rate saved successfully', 'success');
} else {
    // Error occurred while saving the rate
    set_message('error', 'Failed to save the rate. Please try again.');
}

$stmt->close();
$conn->close();

// Redirect back to the admin panel page
header("Location: fertilizer_admin.php");
exit();
?>
