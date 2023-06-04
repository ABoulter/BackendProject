<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Videos</title>
    <link rel="stylesheet" href="assets/styles/dashboard.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</head>

<body>
    <?php include("views/templates/dashboardMenu.php") ?>
    <div class="main">
        <div class="details">
            <div class="recentVideos">
                <h1>Edit Videos</h1>
                <div class="cardHeader">


                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File Path</th>
                                <th>Season</th>
                                <th>Episode</th>
                                <th>Release Date</th>
                                <th>Views</th>
                                <th>Duration</th>
                                <th>Entity ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($videos as $video) { ?>
                                <tr>
                                    <td>
                                        <?= $video['id']; ?>
                                    </td>
                                    <td>
                                        <?= $video['title']; ?>
                                    </td>
                                    <td>
                                        <?php if (strlen($video['description']) > 30) { ?>
                                            <span class="description">
                                                <?= substr($video['description'], 0, 30); ?>...
                                            </span>
                                        <?php } else { ?>
                                            <span class="description">
                                                <?= $video['description']; ?>
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $video['filePath']; ?>
                                    </td>
                                    <td>
                                        <?= $video['season']; ?>
                                    </td>
                                    <td>
                                        <?= $video['episode']; ?>
                                    </td>
                                    <td>
                                        <?= $video['releaseDate']; ?>
                                    </td>
                                    <td>
                                        <?= $video['views']; ?>
                                    </td>
                                    <td>
                                        <?= $video['duration']; ?>
                                    </td>
                                    <td>
                                        <?= $video['entityId']; ?>
                                    </td>
                                    <td>
                                        <a href="/adminEditVideo/<?= $video['id']; ?>">Edit</a>
                                    </td>
                                </tr>
                            <?php }
                            ; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <ul>
                        <?php if ($page > 1) { ?>
                            <li><a href="?page=<?= $page - 1 ?>">Previous</a></li>
                        <?php }
                        ; ?>

                        <?php if ($totalPages <= 10) { ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li <?php if ($i === $page)
                                ?>>
                                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php }
                            ; ?>
                        <?php } else { ?>
                            <?php if ($page <= 5) { ?>
                                <?php for ($i = 1; $i <= 10; $i++) { ?>
                                    <li <?php if ($i === $page)
                                    ?>>
                                        <a href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php }
                                ; ?>
                            <?php } else if ($page > ($totalPages - 5)) { ?>
                                    <li class="dots">...</li>
                                <?php for ($i = $totalPages - 9; $i <= $totalPages; $i++) { ?>
                                        <li <?php if ($i === $page)
                                        ?>>
                                            <a href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                <?php }
                                ; ?>
                            <?php } else { ?>
                                    <li class="dots">...</li>
                                <?php for ($i = $page - 4; $i <= $page + 5; $i++) { ?>
                                        <li <?php if ($i === $page)
                                        ?>>
                                            <a href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                <?php }
                                ; ?>
                                    <li class="dots">...</li>
                            <?php }
                            ; ?>
                        <?php }
                        ; ?>

                        <?php if ($page < $totalPages) { ?>
                            <li><a href="?page=<?= $page + 1 ?>">Next</a></li>
                        <?php }
                        ; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>