<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();

// Check if the user is logged in by verifying if 'user_id' exists in the session
if (!isset($_SESSION['user_id'])) {
    echo "<p style='color: red;'> User is not logged in. </p>";
    exit;
}

$ProfileId = $_SESSION['user_id'];

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

error_log("Received JSON: " . $json);

// Get information from database
// Fetch Items
$fetched_items = $conn->prepare("SELECT id, name, link FROM wishlists WHERE user_id = ?");
$fetched_items-> bind_param("i", $ProfileId);
$fetched_items-> execute();
$result = $fetched_items-> get_result();

$items = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $items[] = [
      'id' => $row['id'],
      'name' => $row['name'],
      'link' => $row['link']
    ];
  }
}

$conn->close();

// Send JSON back to JavaScript
header('Content-Type: application/json');
echo json_encode($items);

?>