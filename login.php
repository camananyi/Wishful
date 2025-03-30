<?php

$is_invalid = false; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE username = '%s'",
                   $mysqli->real_escape_string($_POST["username"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password"])) {

            session_start();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: home1.html");
            exit;
        }
    }

    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="login2.css" />
  </head>
  <body>
    
  <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>

  <div class="square">
    <form method="post">
    <p>Login!?????Q!!!</p>
    <label for="Uname">Username</label>
    <input type="text" id="username" name="username"
        value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">

    <label for="Pass">Password</label>
    <input type="text" id="password" name="password">

    <a class="button">Login</a>
  </form>
  </div>

  </body>
</html>
