<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/styles/style.css" />

    <script src="https://kit.fontawesome.com/07c012f958.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>

    <title>TV Shows</title>

</head>


<body>
    <?php include("views/templates/navbar.php") ?>
    <div class="wrapper">
        <?php include("views/templates/preview.php") ?>
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