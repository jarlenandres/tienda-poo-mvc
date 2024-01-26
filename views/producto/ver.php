<?php if(isset($pro)): ?>
    <h1><?=$pro->nombre?></h1>
    <div id="product-detail">
        <div class="image">
            <?php if($pro->imagen !=null): ?>
                <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="">
            <?php else: ?>
                <img src="<?=base_url?>assets/img/logo.jpg" alt="">
            <?php endif; ?>
        </div>
        <div class="data">
            <strong>Caracteristicas:</strong>
            <p><?=$pro->descripcion?></p>
            <br>
            <strong>Precio:</strong>
            <p><?=$pro->precio?></p>
            <br>
            <strong>Stock:</strong>
            <p><?=$pro->stock?></p>
            <br>
            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>