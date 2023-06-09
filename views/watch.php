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
    <script> document.addEventListener("DOMContentLoaded", () => {
            initVideo("<?= $video['id']; ?>", "<?= $userId ?>");
        })</script>
    <title>
        <?= "Episode " . " " . $video['episode'] . " " . $video['title'] ?>
    </title>
</head>

<body>
    <div class="wrapper">
        <div class="watchContainer">
            <div class="videoControls watchNav">
                <button onclick="goBack()" aria-label="Go back button"><i class="fa-solid fa-arrow-left"
                        style="color: #ffffff;"></i></button>
                <h1>
                    <?= " " . $video['title'] ?>
                </h1>
            </div>
            <div class="videoControls upNext" style="display:none;">

                <div class="upNextContainer">
                    <button onclick="restartVideo();" aria-label="Watch again">
                        <i class="fas fa-redo" style="color: #ffffff;"> </i>
                    </button>
                    <?php if ($upNextVideo) {
                        if ($upNextVideo['isMovie'] == 0) {
                            if ($upNextVideo['entityId'] != $video['entityId']) { ?>
                                <h2>
                                    <?= "Watch: " . $upNextVideo['entityName'] ?>
                                </h2>
                            <?php }
                            ?>
                            <h2>Up next:</h2>
                            <h3>
                                <?= $upNextVideo['title'] ?>
                            </h3>
                            <h3>
                                <?= " Season " . $upNextVideo['season'] . " - Episode " . $upNextVideo['episode'] ?>
                            </h3>
                            <button class="playNext" onclick="watchVideo(<?= $upNextVideo['id'] ?>);" aria-label="Next episode">
                                <i class="fas fa-play" style="color: #ffffff;"></i>
                            </button>
                        <?php } else { ?>
                            <h2>Up next:</h2>
                            <h3>
                                <?= $upNextVideo['entityName'] . " - The Movie" ?>
                            </h3>

                            <button class="playNext" onclick="watchVideo(<?= $upNextVideo['id'] ?>);"
                                aria-label="Next series or movie">
                                <i class="fas fa-play" style="color: #ffffff;"></i>
                            </button>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <video controls autoplay onended="showUpNext();">
                <source src='/<?= $video['filePath'] ?><?= $startTime ? "#t=" . $startTime : "" ?>' type="video/mp4">
            </video>
        </div>




    </div>
</body>

</html>