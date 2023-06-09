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
    <?php include("views/templates/navbar.php") ?>
    <div class="wrapper">
        <div class='previewContainer'>
            <video autoplay muted class='previewVideo'>
                <?php if ($lastSeenVideo) { ?>
                    <source src='/<?= $lastSeenVideo['filePath'] ?>' type='video/mp4'>
                <?php } else { ?>
                    <source src='/<?= $firstEpisodeId['filePath'] ?>' type='video/mp4'>
                <?php } ?>

            </video>
            <div class="previewOverlay">
                <div class="mainDetails">
                    <h1>
                        <?= $entity["name"] ?>
                    </h1>

                    <?php if (!$video['isMovie']) { ?>

                        <?php if ($lastSeenVideo && $lastSeenVideo["entityId"] == $id) { ?>

                            <h2>
                                <?= $lastSeenVideo['title']; ?>
                            </h2>
                            <h3>
                                <?= "Season " . $lastSeenVideo['season'] . " - Episode " . $lastSeenVideo["episode"]; ?>
                            </h3>
                        <?php } else { ?>
                            <h2>
                                <?= $firstEpisodeId['title']; ?>
                            </h2>
                            <h3>
                                <?= "Season " . $firstEpisodeId['season'] . " - Episode " . $firstEpisodeId["episode"]; ?>
                            </h3>

                        <?php } ?>
                    <?php } ?>
                    <div class='buttons'>
                        <?php if ($lastSeenVideo && $lastSeenVideo["entityId"] == $id && $lastSeenVideo["isFinished"] == 0) { ?>
                            <button onclick="watchVideo(<?= $lastSeenVideo['videoId'] ?>)">
                                <i class='fas fa-play'></i> Continue Watching
                            </button>
                        <?php } else { ?>
                            <button onclick="watchVideo(<?= $firstEpisodeId['id'] ?>)"><i class='fas fa-play'></i>
                                Play</button>
                        <?php } ?>
                        <button onclick='volumeToggle(this)'><i class='fas fa-volume-off'></i></button>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($videos as $seasonNumber => $seasonVideos) { ?>
            <?php if (!$seasonVideos[0]['isMovie']) { ?>
                <div class='season'>
                    <h2>
                        Season
                        <?= $seasonNumber ?>
                    </h2>
                    <div class='videos'>
                        <?php foreach ($seasonVideos as $video) { ?>
                            <a href="/watch/<?= $video['id'] ?>">
                                <div class='episodeContainer'>
                                    <div class='contents'>
                                        <img src='/<?= $entity['thumbnail'] ?>' alt='<?= $video['title'] ?>'>
                                        <div class='videoInfo'>
                                            <h3>
                                                <?= $video['episode'] . '-' . $video['title'] ?>
                                            </h3>
                                            <span>
                                                <?= $video['description'] ?>
                                            </span>
                                        </div>
                                        <?php if (in_array($video['id'], $hasSeen)) { ?>
                                            <i class='fa-solid fa-circle-check seen'></i>
                                        <?php } ?>

                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>

</html>