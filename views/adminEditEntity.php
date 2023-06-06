<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Entity</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/07c012f958.js"></script>
    <link rel="stylesheet" href="/assets/styles/dashboard.css">

</head>

<body>
    <?php include("views/templates/dashboardMenu.php") ?>
    <div class="main">
        <?php if (isset($successMessage) && $successMessage === "Entity successfully deleted") { ?>
            <div class="deletedContainer">
                <h1 class="deletedEntity">Entity removed</h1>
                <a href="/adminEntity">Return to Entity list</a>
            </div>

        <?php } else { ?>
            <h1 class="formHeader">
                <?= "Edit: " . $entity['name'] ?>
            </h1>
            <form class="editForm" method="POST" action="/adminEditEntity/<?= $id; ?>" enctype="multipart/form-data">
                <label for="title">Name:</label>
                <input type="text" id="title" name="title" value="<?= $entity['name']; ?>">

                <label for="description">Thumbnail:</label>
                <input type="file" id="thumbnail" name="thumbnail">

                <label for="filepath">Preview:</label>
                <input type="file" id="preview" name="preview">

                <label for="entityCategory">Category:</label>
                <select id="entityCategory" name="categorySelect">
                    <option value="">-- Select Category --</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                    <?php } ?>
                </select>

                <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                <button type="submit" class="updateEntityBtn" name="updateEntity">Update</button>
                <button type="submit" class="deleteEntityBtn" name="deleteEntity">Delete</button>

                <?php
                if (isset($successMessage)) {
                    echo '<span class="alertSuccess">' . $successMessage . '</span>';
                }
                ?>
                <a href="/adminEntity">Return to entity list</a>
            </form>
        <?php } ?>
    </div>




</body>

</html>