<?php

session_start();

// create profile if does not exsist
// write proflie id and whislist id in sharedwishlist database
// send an email

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $friendUsername = $_POST['share_user'];
    $WishlistId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    $host = "db5017609052.hosting-data.io";
    $dbname = "dbs14095223";
    $username = "dbu2385668";
    $password = "Cam2011Code";

    $mysqli = new mysqli($host, $username, $password, $dbname);

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // check for connection error
    if ($mysqli->connect_errno) {
        die("Connection error: " . $mysqli->connect_error);
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
    if ($friendUsername) {
        $to = $friendEmail;
        $subject = "Someone shared a wishlist with you!";
        $message = "Click here to see the wishlist: http://camananyi.com/camgithub/profilelist.html?id=$wishlistId";
        $headers = "From: noreply@wishful.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent!";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "User not found.";
    }
    

}
?>

