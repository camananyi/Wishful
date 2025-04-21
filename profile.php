<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
  
}
else {
  session_destroy();

  header("Location: index.html");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Wishlists</title>
  <link rel="stylesheet" href="profile.css" />
  <script defer src="profile.js"></script>
</head>

<body>

  <div class="top-bar">
    <?php if (isset($user)): ?>
      <div class="user-info">
        <p class="username-display">Username: <strong><?= htmlspecialchars($user["username"]) ?></strong></p>
        <p><a class="logout-link" href="logout.php">Log out</a></p>
      </div>
    <?php endif; ?>

    <span class="addBtn" onclick="openForm()"> + </span>
  </div>

  <!-- Popup Form -->
  <div class="form-popup" id="popupForm" >
    <form action="create_wishlist.php" method="POST">
      <label for="wishlist_name"><b>Wishlist Name</b></label>
      <input type="text" placeholder="e.g. Birthday List" name="wishlist_name" required>

      <button type="sumbit" class="btn add" onclick="newElement()">Create</button> 
      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
  </div>

  <!-- Wishlist Card Example -->
  <div class="card" id="wishlistsContainer">
    <div class="container">
      <h4><b>Christmas List</b></h4>
      <p>13 April 2025</p>
    </div>
  </div>

  <!-- <ul id="myUL" class ></ul> -->

  <div id="wishlistsContainer"></div>

</body>
</html>
