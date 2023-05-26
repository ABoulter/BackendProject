<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/styles/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/07c012f958.js" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>

    <title>
        <?= $entity["name"] ?>
    </title>

</head>

<body>
    <div class="wrapper">
        <div class='previewContainer'>
            <img src='/<?= $entity['thumbnail'] ?>' class='previewImage' alt='<?= $entity['name'] ?>' hidden>
            <video autoplay muted class='previewVideo' onended='previewEnded'>
                <source src='/<?= $entity['preview'] ?>' type='video/mp4'>
            </video>
            <div class='previewOverlay'>
                <div class='mainDetails'>
                    <h1>
                        <?= $entity['name'] ?>
                    </h1>
                    <div class='buttons'>
                        <button><i class='fas fa-play'></i></button>
                        <button onclick='volumeToggle(this)'><i class='fas fa-volume-off'></i></button>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>