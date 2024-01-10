<?php ?>

<html lang="en">
    <head>
        <title> Sign up </title>
    </head>
    <body>
        <div class="signup-container">
            <h2>Sign up</h2>
            <form action="sign_up.php" method="post">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="submit">
            </form>
        </div>
    </body>
</html>