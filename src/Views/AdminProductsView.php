<?php
include(TEMPLATE_DIR . "Head.inc.php");
include(TEMPLATE_DIR . "Nav.inc.php");

$theme = $_COOKIE['theme'] ?? 'light';
?>

<div class="overlay"></div>

<dialog class="window" data-theme="<?= $theme ?>">
    <form action="POST">
        <input type="text" name="nombre" placeholder="<?= $t['product_name'] ?>">
        <input type="text" name="fabricante" placeholder="<?= $t['manufacturer'] ?>">
        <input type="number" name="pvp" step=".01" placeholder="<?= $t['product_price'] ?>">
        <input type="number" name="stock" placeholder="<?= $t['product_stock'] ?>">
        <input type="text" name="picture" placeholder="<?= $t['product_image'] ?>">
        <input type="text" name="link" placeholder="<?= $t['product_link'] ?>">
        <div class="buttons">
            <button class="button cancel"><?= $t['cancel'] ?></button>
            <button type="submit" class="button save"><?= $t['save'] ?></button>
        </div>
        <!-- En caso de error mostrará este mensaje -->
        <p class="error hide"></p>
        <!-- En caso de éxito mostrará este mensaje -->
        <p class="success hide"></p>
    </form>
</dialog>

<main class="results" data-theme="<?= $theme ?>">
    <?php foreach($data as $k=>$v): ?>

        <div id="<?php echo $data[$k]['id'] ?>" class="product">
            <img src="<?php echo $data[$k]['picture'] ?>" class="picture" alt="">
            <h3 class="nombre"><?php echo $data[$k]['nombre'] ?></h3>
            <p class="fabricante">
                <?php echo $data[$k]['fabricante'] ?>
            </p>
            <div>
                <p class="pvp"><?= $t['price'] ?>: <?= $data[$k]['pvp'] ?>€</p>
                <p class="stock"><?= $t['stock'] ?>: <?= $data[$k]['stock'] ?></p>
            </div>
            <div>
                <button type="button" id="<?php echo $data[$k]['id'] ?>" class="link button shopCartBtn" style="text-decoration:none">
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
                <button class="button greenBtn edit" style="text-decoration:none">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="button redBtn delete" style="text-decoration:none">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>

    <?php endforeach; ?>

    <div class="addProduct">
        <a href="add-product" class="button" style="text-decoration:none">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
</main>

<template id="productTemplate">
    <div id="" class="product">
        <img src="" class="picture" alt="">
        <h3 class="nombre"></h3>
        <p class="fabricante">
            
        </p>
        <div>
            <p class="pvp"></p>
            <p class="stock"></p>
        </div>
        <div>
            <a href="" class="button link" style="text-decoration:none" target="_blank">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
            <button class="button greenBtn edit" style="text-decoration:none">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button class="button redBtn delete" style="text-decoration:none">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </div>
</template>

<script type="module" src="public/js/main.js"></script>