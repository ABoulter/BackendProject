<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new Video</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="assets/styles/dashboard.css">
</head>

<body>
    <?php include("views/templates/dashboardMenu.php") ?>
    <div class="main">
        <h1 class="formHeader">Create Video</h1>
        <form class="createForm" method="POST" action="/adminAdd" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="filepath">Video:</label>
            <input type="file" id="filepath" name="filePath" required>

            <label for="season">Season:</label>
            <input type="number" id="season" name="season">

            <label for="episode">Episode:</label>
            <input type="number" id="episode" name="episode">

            <label for="releaseDate">Release Date:</label>
            <input type="date" id="releaseDate" name="releaseDate" required>

            <label for="entitySelect">Select Entity:</label>
            <select id="entitySelect" name="entitySelect">
                <option value="">-- Select Entity --</option>
                <?php foreach ($entities as $entity) { ?>
                    <option value="<?= $entity['id']; ?>"><?= $entity['name']; ?></option>
                <?php } ?>
            </select>

            <label for="isMovie">Is it a Movie?</label>
            <select id="isMovie" name="isMovie">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
            <button type="submit" name="createVideo">Create</button>
            <a href="/adminEdit">Cancel</a>
            <?php
            if (isset($successMessage)) {
                echo '<span class="alertSuccess">' . $successMessage . '</span>';
            } else if (isset($errorMessage)) {
                echo '<span class="alertError">' . $errorMessage . '</span>';
            }
            ?>
        </form>
    </div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const isMovieSelect = document.getElementById("isMovie");
        const seasonLabel = document.querySelector("label[for='season']");
        const episodeLabel = document.querySelector("label[for='episode']");
        const seasonInput = document.getElementById("season");
        const episodeInput = document.getElementById("episode");


        isMovieSelect.addEventListener("change", function () {
            if (isMovieSelect.value === "1") {

                seasonLabel.style.display = "none";
                episodeLabel.style.display = "none";
                seasonInput.style.display = "none";
                episodeInput.style.display = "none";
            } else {

                seasonLabel.style.display = "block";
                episodeLabel.style.display = "block";
                seasonInput.style.display = "block";
                episodeInput.style.display = "block";
            }
        });


        isMovieSelect.dispatchEvent(new Event("change"));
    });
</script>

</html>