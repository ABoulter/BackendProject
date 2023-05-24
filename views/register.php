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
                <h3>Sign Up</h3>
                <h4>to continue to Ductape</h4>
            </div>

            <form method="POST">

                <?= isset($users) ? $users->getError(Errors::$firstNameCharacters) : ""; ?>
                <input type="text" name="firstName" placeholder="First Name"
                    value="<?php RememberFields::getInputValue("firstName"); ?>" required>
                <?= isset($users) ? $users->getError(Errors::$lastNameCharacters) : ""; ?>
                <input type="text" name="lastName" placeholder="Last Name"
                    value="<?php RememberFields::getInputValue("lastName"); ?>" required>
                <?= isset($users) ? $users->getError(Errors::$usernameCharacters) : ""; ?>
                <?= isset($users) ? $users->getError(Errors::$usernameTaken) : ""; ?>
                <input type="text" name="username" placeholder="Username"
                    value="<?php RememberFields::getInputValue("username"); ?>" required>
                <?= isset($users) ? $users->getError(Errors::$emailsDontMatch) : ""; ?>
                <?= isset($users) ? $users->getError(Errors::$invalidEmail) : ""; ?>
                <?= isset($users) ? $users->getError(Errors::$emailTaken) : ""; ?>
                <input type="email" name="email" placeholder="Email"
                    value="<?php RememberFields::getInputValue("email"); ?>" required>
                <input type="email" name="email2" placeholder="Confirm email" required>
                <?= isset($users) ? $users->getError(Errors::$passwordLength) : ""; ?>
                <?= isset($users) ? $users->getError(Errors::$passwordsDontMatch) : ""; ?>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Confirm password" required>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                <button type="submit" name="submitButton">SUBMIT</button>

            </form>
            <a href="/login" class="signInMessage">Already have an users? Sign in here!</a>
        </div>
    </div>

</body>

</html>