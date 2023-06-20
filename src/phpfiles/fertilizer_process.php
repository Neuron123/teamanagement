<?php
session_start();
include "messages.php";
?>

<?php
// Prepare the SQL statement
include "conn.php";

// Get the form data
$growerNo = $_POST['grower_no'];
$amount = $_POST['amount'];
echo $growerNo;
echo $amount;

// Prepare the INSERT statement
$sql = "INSERT INTO fertilizer (grower_no, amount) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameters
    $stmt->bind_param("sd", $growerNo, $amount);

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        // Redirect to fertilizer.php
        set_message('Application submitted successfully', 'success');
        header("Location: fertilizer.php");
        exit();
    } else {
        
        // Redirect to fertilizer.php
        set_message('An error occurred', 'error');
        header("Location: fertilizer.php");
        exit();
    }

    // Close the statement
    $stmt->close();
} 

// Close the database connection
$conn->close();
?>