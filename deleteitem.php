<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start(); // Start the session

// Database connection parameters
$host = "db5017609052.hosting-data.io";
$dbname = "dbs14095223";
$username = "dbu2385668";
$password = "Cam2011Code";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Make sure session has user_id
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit;
}

// Retrieve the JSON data from the request
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$ProfileId = $_SESSION['user_id'];


$itemId = $data['id']; // This is the ID of the wishlist item

// Prepare and bind the SQL statement
$stmt = $conn->prepare("DELETE FROM wishlist WHERE id = ? AND ProfileId = ?");
$stmt->bind_param("ii", $itemId, $ProfileId); // both are integers

// Execute the statement
if ($stmt->execute()) {
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record: " . $stmt->error;
}


// Close connections
$stmt->close();
$conn->close();
?>