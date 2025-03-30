<?php

    if(array_key_exists('Login', $_POST)) {
        login();
    }

$is_invalid = false; 

function login() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
        $mysqli = require __DIR__ . "/database.php";
        
        $sql = sprintf("SELECT * FROM user
                        WHERE username = '%s'",
                       $mysqli->real_escape_string($_POST["username"]));
    
        print_r($_POST["username"]);
        print_r($sql);
        
        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();
        
        if ($user) {
            print_r($_POST);
            echo "Sign Up Succesful";
    
            
            if (password_verify($_POST["password"], $user["password"])) {
    
                session_start();
                echo "password verify called";
                
                $_SESSION["user_id"] = $user["id"];
                
                header("Location: index.php");
                exit;
            }
        }
    
        $is_invalid = true;
    } 
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
    <p>Login!!</p>
    <label for="Uname">Username</label>
    <input type="text" id="username" name="username"
        value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">

    <label for="Pass">Password</label>
    <input type="text" id="password" name="password">

    <input type="submit" name="Login"
                class="button" value="Login" />
  </form>
  </div>

  </body>
</html>
