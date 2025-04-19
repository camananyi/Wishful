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
<head>
  <title>My Wishlists</title>
  <link rel="stylesheet" href="profile.css" />
</head>
<body>

  <div class="top-bar">
    <?php if (isset($user)): ?>
      <div class="user-info">
        <p class="username-display">Username: <strong><?= htmlspecialchars($user["username"]) ?></strong></p>
        <p><a class="logout-link" href="logout.php">Log out</a></p>
      </div>
    <?php endif; ?>

    <!-- Button to reveal the form (can make fancier with JS later) -->
    <form action="create_wishlist.php" method="POST">
      <input type="text" name="wishlist_name" placeholder="New wishlist name" required>
      <button class="addBtn" type="submit"> + </button>
    </form>
  </div>

  <!-- Example wishlist card -->
  <div class="card">
    <div class="container">
      <h4><b>Christmas List</b></h4>
      <p>13 April 2025</p>
    </div>
  </div>

</body>
</html>
