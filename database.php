<?php

$host = "sql3.freesqldatabase.com";
$dbname = "sql3770314";
$username = "sql3770314";
$password = "yDQZ9XMRJ9";

$mysqli = new mysqli($host, $username, $password, $dbname);

// check for connection error
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;