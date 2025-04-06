<?php
// Show errors (for debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Your InfinityFree MySQL database details
$host = "sql105.camille.great-site.net";
$dbname = "if0_38682095_wishful";
$username = "if0_38682095";
$password = "97YQK2nv278B0"; // replace this with your actual password

// Try to connect
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("❌ Connection failed: " . $mysqli->connect_error);
}

echo "✅ Connected to the database successfully!";
?>
