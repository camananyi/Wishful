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

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["wishlist_name"];
    $user_id = $_SESSION["user_id"];
    $date = date("m/d/Y");

    // Insert into the wishlists table
    $query = "INSERT INTO multi_wishlist (ProfileId, WishlistName, Date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $name, $date);
    $stmt->execute();

    echo json_encode(["success" => true]);

    $stmt->close();
    $conn->close();

    // Redirect back to the page
    // header("Location: profile.php"); 
    exit();
}
?>
