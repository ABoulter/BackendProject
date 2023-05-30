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
<?php include("views/templates/navbar.php") ?>

<body>
    <div class="wrapper">
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
        <div class='previewCategories'>
            <?php foreach ($categories as $category) {
                $categoryId = $category['id'];
                $categoryEntities = $entities[$categoryId];
                if (!empty($categoryEntities)) {
                    ?>
                    <div class='category'>
                        <h2>
                            <?= $category['name']; ?>
                        </h2>
                        <div class='entities'>
                            <?php foreach ($categoryEntities as $entity) {
                                $id = $entity['id'];
                                $thumbnail = $entity['thumbnail'];
                                $name = $entity['name'];
                                ?>
                                <a href='streamPage/<?= $id ?>'>
                                    <div class='previewContainer small'>
                                        <img src='/<?= $thumbnail ?>' title='<?= $name ?>' alt='<?= $name ?>'>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</body>

</html>