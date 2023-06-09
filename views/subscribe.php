<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/styles/style.css" />

    <script src="https://kit.fontawesome.com/07c012f958.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>

    <title>Ductape</title>

</head>

<body>
    <?php include("views/templates/navbar.php") ?>
    <div class="wrapper">
        <div class="subcsribeContainer">
            <h1>Subscribe now to watch Ductapes Content!</h1>
            <h2>Get your 7 days free trial!</h2>
            <div class="message">
                <?php if (isset($wrongMessage)) {
                    echo '<div class="alertError"> ' . $wrongMessage . ' </div>';
                } else if (isset($cancelledMessage)) {
                    echo '<div class="alertError"> ' . $cancelledMessage . ' </div>';
                } ?>
            </div>
            <a href="/billing"> Subscribe to Ductape </a>
            <?php

            if ((bool) $user["isSubscribed"]) {
                $_SESSION["subscribed"] = 1;
                header("Location: /profile");
                exit();
            }

            ?>
        </div>

    </div>
    </div>
</body>

</html>