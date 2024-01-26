<?php if(isset($_SESSION['identity'])): ?>
    <h1>Realizar pedido</h1>
    <p>
        <a href="<?=base_url?>carrito/index">Ver mis productos</a>
    </p>
    <br>
    <h3>Dirección de domicilio</h3>
    <form action="<?=base_url?>pedido/add" method="post">
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad">

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion">

        <input type="submit" value="Confirmar pedido">
    </form>
<?php else: ?>
    <h1>No estas identificado</h1>
    <p>Inicia sesión para realizar tu pedido</p>
<?php endif; ?>
