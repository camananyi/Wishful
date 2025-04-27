<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start(); // Start the session

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    die("User not logged in.");
    exit;
}

$ProfileId = $_SESSION['user_id'];
$WishlistId = isset($_GET['id']) ? intval($_GET['id']) : 0;


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
$fetched_items = $conn->prepare("SELECT id, ItemName, ItemLink FROM wishlist WHERE ProfileId = ? AND WishlistId = ?");
$fetched_items->bind_param("ii", $ProfileId, $WishlistId);
$fetched_items->execute();
$result = $fetched_items->get_result();

$items = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = [
            'id' => $row['id'],
            'name' => $row['ItemName'],
            'link' => $row['ItemLink']
        ];
    }
} else {
    $items = []; // Return an empty array if no items are found
}

$conn->close();

// Send JSON back to JavaScript
header('Content-Type: application/json');
echo json_encode($items);

?>