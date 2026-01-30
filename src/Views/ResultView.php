<?php
    include(TEMPLATE_DIR . "Head.inc.php");
    include(TEMPLATE_DIR . "Nav.inc.php");

    $theme = $_COOKIE['theme'] ?? 'light';
?>

<main class="results" data-theme="<?= $theme ?>">

    <?php foreach($data as $k=>$v): ?>

        <div class="product">
            <img src="<?php echo $data[$k]['picture'] ?>" id="picture" alt="">
            <h3 id="nombre"><?php echo $data[$k]['nombre'] ?></h3>
            <p class="fabricante" id="fabricante">
                <?php echo $data[$k]['fabricante'] ?>
            </p>
            <div>
                <p><?= $t['price'] ?>: <?= $data[$k]['pvp'] ?>€</p>
                <p><?= $t['stock'] ?>: <?= $data[$k]['stock'] ?></p>
            </div>
            <button type="button" id="<?php echo $data[$k]['id'] ?>" class="button shopCartBtn" style="text-decoration:none"><?= $t['add_to_cart'] ?></a>
        </div>

    <?php endforeach; ?>
    
</main>

<script type="module" src="public/js/main.js"></script>