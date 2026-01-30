<?php
    include(TEMPLATE_DIR . "Head.inc.php");

// /login-submit
$theme = $_COOKIE['theme'] ?? 'light';
?>

<main class="login" data-theme="<?= $theme ?>">
    <form method="POST">
        <h1><?= $t['login_title'] ?></h1>
        <input type="text" name="usuario" placeholder="<?= $t['username_placeholder'] ?>">
        <input type="password" name="password" placeholder="<?= $t['password_placeholder'] ?>">
        <button class="button"><?= $t['login_button'] ?></button>
        <!-- En caso de error mostrará el mensaje -->
        <p class="error hide"></p>
        <div class="noAccount">
            <p><?= $t['no_account'] ?></p>
            <a href="/register"><?= $t['register'] ?></a>
        </div>
    </form>
</main>

<script type="module" src="public/js/main.js"></script>