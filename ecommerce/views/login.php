<?php
?>
<html lang="en">
<head>
    <title> Login </title>
</head>
<body>
<div class="login-container">
    <h1>Login</h1>
    <form action="../actions/login.php" method="POST">
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="email" id="username" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button>Submit</button>
    </form>
    <div class="register-link">
        <p>Non hai un account? <a href="signup.php">Registrati qui</a>.</p>
    </div>
</div>
</body>
</html>