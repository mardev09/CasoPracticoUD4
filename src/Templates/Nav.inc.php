<?php $theme = $_COOKIE['theme'] ?? 'light'; ?>

<!-- Componente del head -->
<nav class="navbar" data-theme="<?= $theme ?>">
    <a href="inicio">
        <?= $t['navbar_home'] ?>
    </a>
    <a href="show-cart">
        <?= $t['navbar_shopcart'] ?>
    </a>
    <?php if ($_SESSION['isAdmin']) { ?>
        <a href="admin-manage">
            <?= $t['navbar_admin'] ?>
        </a>
    <?php }; ?>
    <select id="langBtn">
        <!--Need to add a conditional to determine whether ES or EN is selected-->
        <?php if ($_SESSION['lang'] == 'es') { ?>
            <option value="es" selected>ES</option>
            <option value="en">EN</option>
        <?php } else { ?>
            <option value="es">ES</option>
            <option value="en" selected>EN</option>
        <?php }; ?>
    </select>
    <button id="themeToggle">
        <i class="fa-solid fa-circle-half-stroke"></i>
    </button>
    <button id="logout">
        <i class="fa-solid fa-right-from-bracket"></i>
    </button>
</nav>