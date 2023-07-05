<?php
session_start();
include "conn.php";

// Filter the records based on the specified time range
$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : null;
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : null;
$startDate = date('Y-m-d', strtotime($startDate));
$endDate = date('Y-m-d', strtotime($endDate));
$filterQuery = "";
$bindTypes = "";
$bindParams = array();

if (!empty($startDate) && !empty($endDate)) {
    $filterQuery = " WHERE created_at BETWEEN ? AND ?";
    $bindTypes = "ss";
    $bindParams[] = $startDate;
    $bindParams[] = $endDate;
}

// Prepare the SQL statement with the filter condition
$sql = "SELECT * FROM tea_measurements WHERE grower_no = ?" . $filterQuery;
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the grower_no value and additional parameters for the filter condition
    $bindParams = array_merge(array("s", $_SESSION['growerno']), $bindParams);
    $stmt->bind_param(...$bindParams);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Initialize an empty array to store the fetched records
    $records = array();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Fetch the rows as an associative array and store them in the $records array
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();

// Return the records as JSON
echo json_encode(['data' => $records]);
?>
