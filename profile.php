<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>
  <link rel="stylesheet" href="profile.css" />
  <body>
    
    <div class="top-bar">
    <?php if (isset($user)): ?>
      <div class="user-info">
        <p class="username-display">Username: <strong><?= htmlspecialchars($user["username"]) ?></strong></p>
        <p><a class="logout-link" href="logout.php">Log out</a></p>
      </div>
    <?php endif; ?>
    
    <span class="addBtn"> + </span>
    </div>
    
      <div class="card">
          <div class="container">
            <h4><b>Christmas List</b></h4>
            <p>13 April 2025</p>
          </div>
        </div>
  </body>
</html>
