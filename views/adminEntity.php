<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entity List</title>
    <link rel="stylesheet" href="assets/styles/dashboard.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</head>

<body>
    <?php include("views/templates/dashboardMenu.php") ?>
    <div class="main">
        <div class="details">
            <div class="recentEntities">
                <h1>Edit Entities</h1>
                <div class="cardHeader">


                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Thumbnail</th>
                                <th>Preview</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entities as $entity) { ?>
                                <tr>
                                    <td>
                                        <?= $entity['id']; ?>
                                    </td>
                                    <td>
                                        <?= $entity['name']; ?>
                                    </td>

                                    <td>
                                        <?= $entity['thumbnail']; ?>
                                    </td>
                                    <td>
                                        <?= $entity['preview']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $category = $categoriesModel->getCategoryName($entity["categoryId"]);
                                        echo $category["name"];
                                        ?>
                                    </td>
                                    <td>
                                        <a href="/adminEditEntity/<?= $entity['id']; ?>">Edit</a>
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