<nav class="topBar">
    <div class="logoContainer">
        <a href="/">
            <img src="/assets/images/ductape.png" alt="Logo">
        </a>
    </div>
    <ul class="navLinks">
        <li>
            <a href="/">Home</a>
        </li>
        <li>
            <a href="/tvShows">TV Shows</a>
        </li>
        <li>
            <a href="/movies">Movies</a>
        </li>
    </ul>
    <div class="rightItems">
        <a href="/search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>
        <a href="/profile">
            <?php if (!$subscribed) { ?>
                <i class="fa-solid fa-user"></i>
            <?php } else { ?>
                <i class="fa-solid fa-user subscribed"></i>
            <?php } ?>
            <?= $username ?>
        </a>


        <?php if ($admin) { ?>
            <a href="/adminDashboard">
                <i class="fa-solid fa-hammer"></i>
            </a>
        <?php } ?>
        <a href="/logout">
            <i class="fa-solid fa-right-from-bracket"></i>
        </a>
    </div>

</nav>