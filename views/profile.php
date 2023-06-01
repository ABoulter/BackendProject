<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
    <title>
        <?= $username . "'s Profile" ?>
    </title>
</head>

<body>
    <?php include("views/templates/navbar.php") ?>
    <div class="wrapper">


        <div class="settingsContainer column">

            <div class="formSection">
                <form method="POST" action="/profile">

                    <h1>User details</h1>

                    <?php

                    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user["firstName"];
                    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user["lastName"];
                    $email = isset($_POST["email"]) ? $_POST["email"] : $user["email"];
                    ?>
                    <input type="text" name="firstName" placeholder="First name" value="<?= $firstName; ?>"
                        aria-label="First name">
                    <input type="text" name="lastName" placeholder="Last name" value="<?= $lastName; ?>"
                        aria-label="Last Name">
                    <input type="email" name="email" placeholder="Email" value="<?= $email; ?>" aria-label="email">
                    <div class="message">
                        <?php if (isset($detailsMessage)) {
                            echo '<div class="alertSuccess">' . $detailsMessage . '</div>';
                        } else if (isset($errorMessage)) {
                            echo '<div class="alertError">' . $errorMessage . ' </div>';
                        } ?>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                    <button type="submit" name="saveDetailsButton" value="Save"
                        aria-label="save your details">Save</button>

                </form>
            </div>

            <div class="formSection">
                <form method="POST" action="/profile">

                    <h1>Update password</h1>
                    <input type="password" name="oldPassword" placeholder="Old password" aria-label="Old password">
                    <input type="password" name="newPassword" placeholder="New password" aria-label="New password">
                    <input type="password" name="newPassword2" placeholder="Confirm new password"
                        aria-label="Confirm new password">
                    <div class="message">
                        <?php if (isset($passwordMessage)) {
                            echo '<div class="alertSuccess">' . $passwordMessage . '</div>';
                        } else if (isset($passwordError)) {
                            echo '<div class="alertError">' . $passwordError . ' </div>';
                        } ?>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                    <button type="submit" name="savePasswordButton" value="Save"
                        aria-label="Save your password">Save</button>

                </form>
            </div>

        </div>

    </div>
    </div>

</body>

</html>