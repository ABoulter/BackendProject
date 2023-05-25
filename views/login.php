<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
    <title>Welcome to Ductape</title>
</head>

<body>
    <div class="signInContainer">
        <div class="column">

            <div class="header">
                <img src="assets/images/ductape.png" title="logo" alt="ductape">
                <h3>Sign In</h3>
                <h4>to continue to Ductape</h4>
            </div>

            <form method="POST">
                <?php
                if (isset($message)) {
                    echo '<span class="errorMessage">' . $message . '</span>';
                }
                ?>
                <input type="text" name="username" placeholder="Username"
                    value="<?php RememberFields::getInputValue("username"); ?>" minlength="3" maxlength="60" required>
                <input type="password" name="password" placeholder="Password" minlength="8" maxlength="1000" required>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                <button type="submit" name="submitButton">SUBMIT</button>

            </form>

            <a href="/" class="signInMessage">Need an account? Sign up here!</a>

        </div>
    </div>

</body>

</html>