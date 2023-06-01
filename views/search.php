<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/styles/style.css" />
    <title>Search</title>
</head>

<body>
    <?php include("views/templates/navbar.php") ?>
    <div class="wrapper">
        <form method="POST" action="/search" class="textboxContainer">
            <input type="text" class="searchInput" placeholder="Search for something to watch"
                aria-label="Search for something to Watch">
        </form>

        <div class="results">
            <div class="previewCategories noScroll">
                <div class="category">
                    <div class="entities">
                        <?php
                        if (!empty($searchResults)) {
                            foreach ($searchResults as $result) {
                                $id = $result['id'];
                                $thumbnail = $result['thumbnail'];
                                $name = $result['name'];
                                ?>
                                <a href='streamPage/<?= $id ?>'>
                                    <div class='previewContainer small'>
                                        <img src='/<?= $thumbnail ?>' title='<?= $name ?>' alt='<?= $name ?>'>
                                    </div>
                                </a>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="noResultsElement">No results found.</div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>