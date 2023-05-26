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
                <h1><img src="/assets/images/ductape.png" title="logo" alt="ductape"></h1>
                <h2>Sign Up</h2>
                <h3>to continue to Ductape</h3>
            </div>

            <form method="POST" action="/register">
                <?php
                if (isset($message)) {
                    echo '<span class="errorMessage">' . $message . '</span>';
                }
                ?>
                <input type="text" name="firstName" placeholder="First Name" minlength="3" maxlength="60"
                    value="<?php RememberFields::getInputValue("firstName"); ?>" aria-label="first name" required>
                <input type="text" name="lastName" placeholder="Last Name" minlength="3" maxlength="60"
                    value="<?php RememberFields::getInputValue("lastName"); ?>" aria-label="last name" required>
                <input type="text" name="username" placeholder="Username" minlength="3" aria-label="username"
                    maxlength="60" value="<?php RememberFields::getInputValue("username"); ?>" required>
                <input type="email" name="email" placeholder="Email"
                    value="<?php RememberFields::getInputValue("email"); ?>" aria-label="email" required>
                <input type="email" name="email2" placeholder="Confirm email" aria-label="confirm email" required>
                <input type="password" name="password" placeholder="Password" minlength="8" maxlength="1000"
                    aria-label="password" required>
                <input type="password" name="password2" placeholder="Confirm password" minlength="8"
                    aria-label="confirm password" maxlength="1000" required>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                <button type="submit" name="submitButton" aria-label="Submit button">SUBMIT</button>
            </form>
            <a href="/login" class="signInMessage">Already have an users? Sign in here!</a>
        </div>
    </div>

</body>

</html>