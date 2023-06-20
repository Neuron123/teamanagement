<?php
session_start();
include "conn.php";
include "messages.php";

// Update the record
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the record ID and new values from the form
    $recordId = $_POST['record_id'];
    $newGrowerNo = $_POST['grower_no'];
    $newQuantity = $_POST['quantity'];

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE tea_measurements SET grower_no=?, quantity=? WHERE id=?");
    $stmt->bind_param("sii", $newGrowerNo, $newQuantity, $recordId);

    // Execute the statement
    if ($stmt->execute()) {
        // Update successful
        $message = "Record updated successfully.";
        set_message($message);
    } else {
        // Update failed
        $message = "Failed to update record.";
        set_message($message);
    }

    // Close the statement
    $stmt->close();
}

// Redirect back to the page
header("Location: tablerecords_admin.php");
exit();
?>
