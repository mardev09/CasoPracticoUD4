<?php
    include(TEMPLATE_DIR . "Head.inc.php");
    
    $theme = $_COOKIE['theme'] ?? 'light';
?>

<main class="register" data-theme="<?= $theme ?>">
    <form action="/register-submit" method="POST">
        <h1><?= $t['register_title'] ?></h1>
        <input type="text" name="usuario" placeholder="<?= $t['username_placeholder'] ?>">
        <input type="password" name="password" placeholder="<?= $t['password_placeholder'] ?>">
        <button class="button"><?= $t['register_button'] ?></button>
        <!-- En caso de error mostrará el mensaje -->
        <p class="error hide"></p>
        <!-- En caso de éxito mostrará este mensaje -->
        <p class="success hide"></p>
        <div class="noAccount">
            <p><?= $t['have_account'] ?></p>
            <a href="/login"><?= $t['go_login'] ?></a>
        </div>
    </form>
</main>

<script type="module" src="public/js/main.js"></script>