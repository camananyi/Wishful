<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (empty($_POST["name"])) {
    die("Name is required");
}

if (empty($_POST["username"])) {
    die("Userame is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, username, email, password)
        VALUES (?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["name"],
                  $_POST["username"],
                  $_POST["email"],
                  $_POST["password"]);
                  

// print_r($_POST);
// echo "Sign Up Succesful";

if ($stmt->execute()) {

    header("Location: login.php");
    exit;
    
} else {
    if ($mysqli->errno === 1062) {
        // Username already taken
        echo "<p style='color: pink;'> That username is already taken. </p>";
    } else {
        // Some other error
        echo "<p style='color: pink;'>Oops! Something went wrong. </p>";
    }
}

?>