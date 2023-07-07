<?php
session_start();

require "conn.php";
include "messages.php";
include "sendsms.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $grower_no = $_POST["grower_no"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $userrole = $_POST["userrole"];

    // Check if the grower_no already exists in the database
    $checkQuery = "SELECT grower_no FROM authentication WHERE grower_no = '$grower_no' AND grower_no != '' ";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Grower_no already exists, handle the error or redirect to an error page
        echo "Error: Grower_no already exists";
        set_message('Error: Grower no already exists ', 'error');
        header("Location: register.php");
        exit(); // Stop further execution
    }

    // Insert data into the database
    $sql = "INSERT INTO authentication (grower_no, firstname, lastname, phone, email, userpassword,  userrole)
            VALUES ('$grower_no', '$firstname', '$lastname', '$phone', '$email', '$hashedPassword', '$userrole')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        set_message('Registration successful', 'success');
        $_SESSION['userrole'] = $userrole; // Set the session for userrole
        $_SESSION['growerno'] = $grower_no;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;
        
        //sendsms
        $message = "Hi, $firstname, you have successfully been registered in the Tea Management System";
        sendSMS($message,$phone);

        if($userrole == 'admin'){
            header("Location: login2.php");
        }
        elseif($userrole == 'clerk'){
            header("Location: login2.php");
        }else{
            header("Location: login2.php");
        }
        
    } else {
        // Registration failed
        echo "Error: " . $sql . "<br>" . $conn->error;
        //header("Location: register.php");
    }

    // Close the database connection
    $conn->close();
}
?>