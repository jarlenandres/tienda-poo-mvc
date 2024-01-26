<h1>Detalle del pedido</h1>

<?php if(isset($pedido)):?>
    <?php if(isset($_SESSION['admin'])): ?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?=base_url?>pedido/estado" method="post">
            <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
            <select name="estado" id="estado">
                <option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '' ?>>Pendiente</option>
                <option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '' ?>>Preparado para enviar</option>
                <option value="sended" <?=$pedido->estado == "sended" ? 'selected' : '' ?>>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
        <br>
    <?php endif; ?>
    
<h3>Datos del usuario</h3>
Nombre: <?=$usuario->nombre?> <?=$usuario->apellidos?><br>
Correo: <?=$usuario->email?><br>
Teléfono: <?=$usuario->telefono?><br>
Ciudad: <?=$pedido->ciudad?><br>
Dirección: <?=$pedido->direccion?><br><br>

<h3>Datos del pedido</h3>
Pedido #: <?=$pedido->id?> <br>
Total a pagar: $<?=$pedido->coste?> <br>
Estado: <?=Utils::showStatus($pedido->estado)?> <br>
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