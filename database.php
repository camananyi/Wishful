<?php

$host = "sql105.infinityfree.com";
$dbname = "if0_38682095_wishful";
$username = "if0_38682095";
$password = "97YQK2nv278B0";

$mysqli = new mysqli($host, $username, $password, $dbname);

// check for connection error
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>