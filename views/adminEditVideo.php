<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ductape Dashboard</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/07c012f958.js"></script>
    <link rel="stylesheet" href="/assets/styles/dashboard.css">

</head>

<body>
    <?php include("views/templates/dashboardMenu.php") ?>
    <div class="main">
        <?php if (isset($successMessage) && $successMessage === "Video successfully deleted") { ?>
            <div class="deletedContainer">
                <h1 class="deletedVideo">Video removed</h1>
                <a href="/adminEdit">Return to Video list</a>
            </div>

        <?php } else { ?>
            <h1 class="formHeader">
                <?= "Edit: " . $video['title'] ?>
            </h1>
            <form class="editForm" method="POST" action="/adminEditVideo/<?= $id; ?>" enctype="multipart/form-data">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?= $video['title']; ?>">

                <label for="description">Description:</label>
                <textarea id="description" name="description"><?= $video['description']; ?></textarea>

                <label for="filepath">File Path:</label>
                <input type="text" id="filepath" name="filepath" value="<?= $video['filePath']; ?>">

                <label for="season">Season:</label>
                <input type="number" id="season" name="season" value="<?= $video['season']; ?>">

                <label for="episode">Episode:</label>
                <input type="number" id="episode" name="episode" value="<?= $video['episode']; ?>">

                <label for="releaseDate">Release Date:</label>
                <input type="date" id="releaseDate" name="releaseDate" value="<?= $video['releaseDate']; ?>">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                <button type="submit" class="updateVideoBtn" name="updateVideo">Update</button>
                <button type="submit" class="deleteVideoBtn" name="deleteVideo">Delete</button>

                <?php
                if (isset($successMessage)) {
                    echo '<span class="alertSuccess">' . $successMessage . '</span>';
                }
                ?>
                <a href="/adminEdit">Return to video list</a>
            </form>
        <?php } ?>
    </div>




</body>

</html>