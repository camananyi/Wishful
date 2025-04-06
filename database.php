<?php

$host = "db5017609052.hosting-data.io";
$dbname = "dbs14095223";
$username = "dbu2385668";
$password = "Cam2011Code";

$mysqli = new mysqli($host, $username, $password, $dbname);

// check for connection error
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
?>