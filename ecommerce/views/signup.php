<?php
?>

<html lang="en">
<head>
    <title> Sign up </title>
</head>
<body>
<div class="signup-container">
    <h2>Registrazione</h2>
    <form action="../actions/signup.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button>Submit</button>
    </form>
</div>
</body>
</html>