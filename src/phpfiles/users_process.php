<?php
session_start();
include "conn.php";
include "messages.php";
include "sendsms.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Get the form input values
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $growerNo = $_POST["growerno"];

    // Set the user ID based on your logic (replace with your own implementation)
    $userId = $_POST["userId"];
    

    // Prepare the statement
    $query = "UPDATE authentication SET firstname=?, lastname=?, phone=?, email=?, userrole=?, grower_no=? WHERE id=?";
    $stmt = $conn->prepare($query);

    // Bind the parameters
    $stmt->bind_param("ssssssi", $firstname, $lastname, $phone, $email, $role, $growerNo, $userId);


    // Execute the statement
    if ($stmt->execute()) {
        // Update successful
        $message = "User details updated successfully.";
        set_message($message);
        //sendsms
        $message = "Hi, $firstname, your information has been updated, your Grower Number is $growerNo";
        sendSMS($message,$phone);
    } else {
        // Update failed
        $message = "Failed to update user details.";
        set_message($message);
    }

    // Close the statement
    $stmt->close();
}

// Redirect back to the page
header("Location: users.php");
exit();
?>