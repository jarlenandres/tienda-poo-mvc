<h1>Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
            
<table id="carrito">
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>
    <?php foreach($carrito as $indice => $elemento): 
        $producto = $elemento['producto'];
    ?>
        <tr>
            <td><?php if($producto->imagen != null): ?>
                    <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="" class="img_carrito">
                <?php else: ?>
                    <img src="<?=base_url?>assets/img/logo.jpg" alt="" class="img_carrito">
                <?php endif; ?>
            </td>
            <td>
                <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
            </td>
            <td><?=$producto->precio?></td>
            <td>
                <?=$elemento['unidades']?>
                <div class="unidades">
                    <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button button-up">+</a>
                    <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button button-up">-</a>
                </div>
            </td>
            <td>
            <a href="<?=base_url?>carrito/remove&index=<?=$indice?>" class="button button-borrar">Borar</a>
            </td>
        </tr>

    <?php endforeach; ?>
        <?php $stats = Utils::statsCarrito(); ?>
        <tr>
            <td>Total:</td>
            <td></td>
            <td><strong>$: <?=$stats['total'] ?></strong></td>
            <td><strong>Uds: <?=$stats['uni']?></strong></td>
        </tr>
</table>
<br>
<a href="<?=base_url?>carrito/delete_all" class="button button-delete">Vaciar carrito</a>
<a href="<?=base_url?>pedido/hacer" class="button button-pedido">Hacer pedido</a>

<?php else: ?>
    <p>Aún no tienes productos en el carrito</p>
<?php endif; ?>