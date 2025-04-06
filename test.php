<?php
$mysqli = new mysqli("sql105.infinityfree.com", "if0_38682095", "97YQK2nv278B0", "if0_38682095_wishful");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "✅ Connection successful!";
?>
