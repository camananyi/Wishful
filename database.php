<?php

$host = "${{ secrets.WISHFUL_HOST }}";
$dbname = "${{ secrets.WISHFUL_DBNAME }}";
$username = "${{ secrets.WISHFUL_DBNAME }}";
$password = "${{ secrets.WISHFUL_PASSWORD }}";

$mysqli = new mysqli($host, $username, $password, $dbname);

// check for connection error
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>