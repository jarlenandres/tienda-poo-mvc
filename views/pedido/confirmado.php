<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
<h1>Tu pedido fue confirmado</h1>
<p>Tu pedido se ha confirmado con exito, procede a realizar tramite de pago</p>
<br>
<?php if(isset($pedido)):?>
<h3>Datos del pedido</h3>

Pedido #: <?=$pedido->id?> <br>
Total a pagar: $<?=$pedido->coste?> <br>
Productos:
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
    <?php while($producto = $productos->fetch_object()): ?>
    <tr>
        <td><?php if($producto->imagen != null): ?>
            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" alt="" class="img_carrito">
            <?php else: ?>
            <img src="<?=base_url?>assets/img/logo.jpg" alt="" class="img_carrito">
            <?php endif; ?>
        </td>
        <td>
            <p href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></p>
        </td>
        <td><?=$producto->precio?></td>
        <td><?=$producto->unidades?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php endif; ?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
<h1>Tu pedido NO ha sido procesado</h1>
<?php endif; ?>