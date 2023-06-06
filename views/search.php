<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/styles/style.css" />
    <script src="https://kit.fontawesome.com/07c012f958.js" crossorigin="anonymous"></script>
    <title>Search Ductape</title>
</head>

<body>
    <?php include("views/templates/navbar.php") ?>
    <div class="wrapper">
        <form method="POST" action="/search" class="textboxContainer">
            <input type="text" name="input" class="searchInput" placeholder="Search for something to watch"
                aria-label="Search for something to Watch">
        </form>

        <div class="results">
            <div class="entities">

            </div>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function () {

                let timer;

                document.querySelector(".searchInput").addEventListener("keyup", function () {
                    clearTimeout(timer);

                    timer = setTimeout(function () {
                        let val = document.querySelector(".searchInput").value;
                        if (val !== "") {
                            const query = { input: val };

                            fetch("/search", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify(query)
                            })
                                .then(response => response.json())
                                .then(function (results) {
                                    const entitiesContainer = document.querySelector(".entities");
                                    entitiesContainer.innerHTML = "";

                                    if (Array.isArray(results) && results.length > 0) {
                                        results.forEach(function (result) {
                                            const entityLink = document.createElement("a");
                                            entityLink.href = 'streamPage/' + result.id;

                                            const previewContainer = document.createElement("div");
                                            previewContainer.classList.add("previewContainer", "small");

                                            const thumbnail = document.createElement("img");
                                            thumbnail.src = result.thumbnail;
                                            thumbnail.title = result.name;
                                            thumbnail.alt = result.name;

                                            previewContainer.appendChild(thumbnail);
                                            entityLink.appendChild(previewContainer);
                                            entitiesContainer.appendChild(entityLink);
                                        });
                                    } else {
                                        entitiesContainer.innerHTML = "<h1>No results found</h1";;
                                    }
                                })
                                .catch(function (error) {
                                    console.error(error);
                                });
                        } else {
                            document.querySelector(".entities").innerHTML = " ";
                        }
                    }, 500);
                });
            });

        </script>
</body>

</html>