<?php
session_start();
require "conn.php";
include "messages.php";
include "sendsms.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $growerNo = $_POST["grower_no"];
    $amount = $_POST["quantity"];
    //$createdAt = date("Y-m-d H:i:s"); // Get the current date and time

    // Query the authentication table to retrieve the firstname for the grower_no
    $query = "SELECT firstname, phone FROM authentication WHERE grower_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $growerNo);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful and if a row was returned
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstname = $row['firstname'];
        $phone = $row['phone'];

        // Insert the record into the database

        // Prepare the SQL statement
        $sql = "INSERT INTO tea_measurements (grower_no, quantity) VALUES (?, ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters to the prepared statement
        $stmt->bind_param("ss", $growerNo, $amount);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Show success message
            set_message('Record added successfully', 'success');

            //sendsms
            $message = "Hi, $firstname, $amount kgs green leaf has been received, for account $growerNo";
            sendSMS($message, $phone);
        } else {
            // Show error message
            set_message('Error adding record: ' . $conn->error, 'error');
        }

        // Close the prepared statement and result set
        $stmt->close();
        $result->close();
    } else {
        // Show error message if no matching grower_no found
        set_message('Invalid grower number', 'error');
    }

    // Close the database connection
    $conn->close();

    // Redirect to the desired page
    header("Location: tablerecords_clerk.php");
    exit();
} 
?>
