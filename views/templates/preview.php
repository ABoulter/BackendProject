<?php if ($video) { ?>
    <div class="previewContainer">
        <video autoplay muted class="previewVideo">
            <source src="/<?= $video['filePath']; ?>" type="video/mp4">
        </video>
        <div class="previewOverlay">
            <div class="mainDetails">
                <h1>
                    <?= $entity["name"] ?>
                </h1>

                <?php if (!$video['isMovie']) { ?>

                    <h2>
                        <?= $video['title']; ?>
                    </h2>
                    <h3>
                        <?= "Season " . $video['season'] . " - Episode " . $video["episode"]; ?>
                    </h3>
                <?php } ?>
                <div class="buttons">
                    <button onclick="watchVideo(<?= $video['id']; ?>)">
                        <i class="fa-solid fa-play"></i>
                        <?= $userInProgress ? "Continue watching" : "Play"; ?>
                    </button>
                    <button onclick="volumeToggle(this)">
                        <i class="fa-solid fa-volume-off"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>