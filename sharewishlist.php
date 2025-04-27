<?php

session_start();

// create profile if does not exsist
// write proflie id and whislist id in sharedwishlist database
// send an email

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $wishlistName = $_POST['wishlist_name'];
    $share_user = $_POST['friend_username'];

    // Database connection
    $conn = new mysqli('localhost', 'your_db_user', 'your_db_password', 'your_db_name');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Find friend's email
    $stmt = $conn->prepare("SELECT email FROM users WHERE username = ?");
    $stmt->bind_param("s", $friendUsername);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo "Username not found.";
        exit();
    }

    $row = $result->fetch_assoc();
    $friendEmail = $row['email'];

    // Now send the email
}
?>

