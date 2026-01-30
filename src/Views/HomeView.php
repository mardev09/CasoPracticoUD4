<?php
    include(TEMPLATE_DIR . "Head.inc.php");
    include(TEMPLATE_DIR . "Nav.inc.php");

    $theme = $_COOKIE['theme'] ?? 'light';
?>

<main class="home" data-theme="<?= $theme ?>">
    <h1><?= $t['welcome'] ?> <?= $_SESSION['user'] ?>!</h1>
    <form class="searchBar" action="/search" method="POST">
        <input type="text" name="value" placeholder="<?= $t['search_placeholder'] ?>">
        <button class="Button">
            <i class="fa-solid fa-magnifying-glass"></i>
            <?= $t['search'] ?>
        </button>
    </form>
</main>

<script type="module" src="public/js/main.js"></script>