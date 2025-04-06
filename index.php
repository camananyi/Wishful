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
    <title>Wishful!</title>
    <link rel="stylesheet" href="styles1.css"/>
</head>
<body>

    <img src="https://assets.onecompiler.app/43954nvr8/439d86znu/_Bold%20Lettering%20Tumblr%20Banner.png" alt="Header Image" width="100%" height="165px">
    <section>
        <nav>
            <ul>
                <li><a class="active" href="#">Home</a></li>
                <li><a href="profilelist.html">Profile</a></li>
                <li><a href="#">Inspo</a></li>
                <li><a href="#">Search</a></li>
                <li style="float:right"><a href="#about">About</a></li>
            </ul>
        </nav>
        
        <?php if (isset($user)): ?>
    <div class="user-info">
        <h2 class="title">Welcome back, <?= htmlspecialchars($user["name"]) ?>!</h2>
        <p class="username-display">Username: <strong><?= htmlspecialchars($user["username"]) ?></strong></p>
        <p><a class="logout-link" href="logout.php">Log out</a></p>
    </div>
<?php else: ?>
    <div class="guest-info">
        <p>Welcome! <a class="login-link" href="login.php">Log in</a> or <a class="signup-link" href="signup.html">sign up</a> to get started!</p>
    </div>
<?php endif; ?>

        <article>
            <h1>London</h1>
            <p>London is the capital city of England. It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
            <p>Standing on the River Thames, London has been a major settlement for two millennia, its history going back to its founding by the Romans, who named it Londinium.</p>
        </article>
    </section>
    
</body>
</html>