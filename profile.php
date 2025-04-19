<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Wishlists</title>
  <link rel="stylesheet" href="profile.css" />
  <style>
    /* POPUP STYLES */
    .form-popup {
      display: none;
      position: fixed;
      bottom: 0;
      right: 15px;
      border: 3px solid #f1f1f1;
      z-index: 9;
      background-color: white;
      max-width: 300px;
      padding: 10px;
    }

    .form-popup input[type=text] {
      width: 95%;
      padding: 10px;
      margin: 10px 0;
      background: #f1f1f1;
      border: none;
    }

    .form-popup .btn {
      width: 100%;
      padding: 12px;
      margin: 5px 0;
      border: none;
      cursor: pointer;
    }

    .form-popup .add {
      background-color: #d5b4bb;
      color: white;
    }

    .form-popup .cancel {
      background-color: grey;
      color: white;
    }

    .form-popup .btn:hover {
      opacity: 0.9;
    }

    .addBtn {
      font-size: 24px;
      background: #d5b4bb;
      color: white;
      padding: 10px 15px;
      cursor: pointer;
      /*border-radius: 50%; */
    }
  </style>
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
  <div class="form-popup" id="popupForm">
    <form action="create_wishlist.php" method="POST">
      <label for="wishlist_name"><b>Wishlist Name</b></label>
      <input type="text" placeholder="e.g. Birthday List" name="wishlist_name" required>

      <button type="submit" class="btn add">Create</button>
      <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
  </div>

  <!-- Wishlist Card Example -->
  <div class="card">
    <div class="container">
      <h4><b>Christmas List</b></h4>
      <p>13 April 2025</p>
    </div>
  </div>

  <script>
    function openForm() {
      document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
      document.getElementById("popupForm").style.display = "none";
    }
  </script>

</body>
</html>
