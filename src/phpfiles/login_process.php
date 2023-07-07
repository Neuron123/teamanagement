<?php
session_start();

require "conn.php";
include "messages.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $grower_no = $_POST["grower_no"];
    $password = $_POST["password"];
    

    // Check if the grower_no exists in the database
    $checkQuery = "SELECT * FROM authentication WHERE grower_no = '$grower_no'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows == 1) {
        // Retrieve user data from the database
        $row = $checkResult->fetch_assoc();
        $storedPassword = $row["userpassword"];
        // echo $storedPassword;
        $userrole = $row["userrole"];
        $_SESSION['growerno'] = $grower_no;
        

        // Verify the password
        if (password_verify($password, $storedPassword)) {
            // Password is correct, set the session variables
            $_SESSION['userrole'] = $userrole;
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['phone'];

            // Redirect the user to the appropriate dashboard based on the user role
            if ($userrole == 'admin') {
                header("Location: dashboard_admin.php");
            } elseif ($userrole == 'clerk') {
                header("Location: dashboard_clerk.php");
            } else {
                header("Location: dashboard_farmer.php");
            }
            exit();
        } else {
            // Password is incorrect
            set_message('Invalid credentials', 'error');
            header("Location: login2.php");
            exit();
        }
    } else {
        // Grower_no does not exist
        set_message('Invalid grower number', 'error');
        header("Location: login2.php");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
