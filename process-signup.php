<?php

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
        die("username already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>