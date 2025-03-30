<?php

$host = "WISHFUL_HOST";
$dbname = "WISHFUL_DBNAME";
$username = "WISHFUL_DBNAME";
$password = "WISHFUL_PASSWORD";

$mysqli = new mysqli($host, $username, $password, $dbname);

// check for connection error
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;