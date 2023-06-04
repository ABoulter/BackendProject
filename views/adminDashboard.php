<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ductape Dashboard</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/07c012f958.js"></script>
    <link rel="stylesheet" href="assets/styles/dashboard.css">

</head>

<body>
    <?php include("views/templates/dashboardMenu.php") ?>
    <div class="main">
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">
                        <?= $totalViews; ?>
                    </div>
                    <div class="cardName">Total Views</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="numbers">7,842€</div>
                    <div class="cardName">Earning</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>
        </div>
    </div>
</body>

</html>