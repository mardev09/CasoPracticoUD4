<?php
    include(TEMPLATE_DIR . "Head.inc.php");
    include(TEMPLATE_DIR . "Nav.inc.php");

     $theme = $_COOKIE['theme'] ?? 'light';
?>

<main class="results" data-theme="<?= $theme ?>">
    <?php if(!empty($data)) : ?>
        <?php foreach($data as $k => $v): ?>

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
                <p id="productAmount">
                    <?= $t['quantity'] ?>:
                    <span><?= $_SESSION['shopCartProdAm'][$data[$k]['id']] ?></span>
                </p>
                <button type="button" id="<?php echo $data[$k]['id'] ?>" class="button redBtn shopCartDelete" style="text-decoration:none">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>

        <?php endforeach; ?>
    <?php else : ?>
        <h1 class="noCartProducts">
            <?= $t['cart_empty'] ?>
        </h1>
    <?php endif; ?> 
</main>

<script type="module" src="public/js/main.js"></script>