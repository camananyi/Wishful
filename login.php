<?php
session_start(); // Start session at the beginning

$is_invalid = false; // Global variable

if (isset($_POST['Login'])) {
    login();
}

function login() {
    global $is_invalid; // Ensure we modify the global variable
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mysqli = require __DIR__ . "/database.php";
        
        $sql = sprintf("SELECT * FROM user WHERE username = '%s'",
            $mysqli->real_escape_string($_POST["username"]));

        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();

        if ($_POST["password"] === $user["password"]) {
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;
        }
        $is_invalid = true;
    }
}

if (($is_invalid) == true){
    header("Location: invalidlogin.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="login2.css" />
</head>
<body>
    
<!-- <?php if ($is_invalid): ?>
    <em>Invalid login</em>
<?php endif; ?> -->

<div class="square">
    <form method="post">
        <p>Login!</p>
        <label for="username">Username</label>
        <input type="text" id="username" name="username"
               value="<?= htmlspecialchars($_POST["username"] ?? "") ?>" required>

        <label for="password">Password</label>
        <input type="text" id="password" name="password" required>

        <input type="submit" name="Login" class="button" value="Login" />
    </form>
</div>

</body>
</html>
