<?php
include('dbcon.php');

// Get data from POST
$jobTitle = $_POST['jobTitle'];
$department = $_POST['department'];
$headcountsToFill = $_POST['headcountsToFill'];
$status = $_POST['status'];

// Insert data into the database
$insertQuery = "INSERT INTO `jobs to fill` (jobTitle, department, headcountsToFill, status) VALUES ('$jobTitle', '$department', '$headcountsToFill', '$status')";
if ($conn->query($insertQuery) === TRUE) {
    echo 'Position added successfully';
} else {
    echo 'Error: ' . $conn->error;
}

$response = [
    'success' => true, // or false if the operation wasn't successful
    'message' => 'Position added successfully' // Provide an appropriate message
];

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
