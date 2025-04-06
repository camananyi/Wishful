<?php
// Show errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Replace these with your real credentials from InfinityFree
$host = "sql105.infinityfree.com"; // <- double check this from Control Panel
$dbname = "if0_38682095_wishful";
$username = "if0_38682095";
$password = "97YQK2nv278B0";

// Try to connect
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("❌ Connection failed: " . $mysqli->connect_error);
} else {
    echo "✅ Connected successfully!";
}
?>
