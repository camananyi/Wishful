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

            die ("Login Succesful");
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
    <form method="post" novalidate>
    <p>Login!</p>
    <label for="Uname">Username</label>
    <input type="text" id="username" name="username">

    <label for="Pass">Password</label>
    <input type="text" id="password" name="password">

    <a href="" class="button">Login</a>
  </form>
  </div>

  </body>
</html>
