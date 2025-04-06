<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$host = "db5017609052.hosting-data.io";
$dbname = "dbs14095223";
$username = "dbu2385668";
$password = "Cam2011Code";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the JSON data from the request
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$json = file_get_contents('php://input');
error_log("Received JSON: " . $json);
$data = json_decode($json, true);

// Validate Input
if (isset($data['name']) && isset($data['link'])) {
    $name = $conn->real_escape_string($data['name']);
    $link = $conn->real_escape_string($data['link']);
} else {
    // Handle the case where expected data is missing
    die("Error: Missing 'name' or 'link' in input data.");
}

// $ItemName = $conn->real_escape_string($data['name']);
// $ItemLink = $conn->real_escape_string($data['link']);

// Prepare and bind - put information into datatbase
$stmt = $conn->prepare("INSERT INTO wishlist (ItemName, ItemLink) VALUES (?, ?)");
$stmt->bind_param("ss", $ItemName, 
                        $ItemLink);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
