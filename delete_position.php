<?php
include('dbcon.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $positionId = $_POST['id'];

    // Perform the delete operation (replace with your actual delete query)
    $deleteQuery = $conn->prepare("DELETE FROM `jobs_to_fill` WHERE id = ?");
    $deleteQuery->bind_param("i", $positionId);

    if ($deleteQuery->execute()) {
        $response = [
            'success' => true,
            'message' => 'Position deleted successfully'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Position could not be deleted'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Position could not be deleted: ' . $conn->error
        ];
    }

    // Close the database connection
    $deleteQuery->close();
    $conn->close();
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid request'
    ];
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
