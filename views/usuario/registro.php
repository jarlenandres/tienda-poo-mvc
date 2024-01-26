<?php if(isset($edit) && isset($user) && is_object($user)): ?>
    <h1>Editar el usuario <?=$user->nombre?> <?=$user->apellidos?></h1>
    <?php $url_action = base_url."usuario/save&id=".$user->id; ?>
<?php elseif($_SESSION['admin']): ?>
    <h1>Crear usuario</h1>
    <?php $url_action = base_url."usuario/save"; ?>
<?php else: ?>
    <h1>Registrarse</h1>
    <?php $url_action = base_url."usuario/save"; ?>
<?php endif; ?>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'):?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
    <strong class="alert_red">Fallas en el registro de datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>

<div class="form-container">
    <form action="<?=$url_action?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="<?=isset($user) && is_object($user) ? $user->nombre : ''; ?>">

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" required value="<?=isset($user) && is_object($user) ? $user->apellidos : ''; ?>">

        <label for="email">Correo</label>
        <input type="email" name="email" required value="<?=isset($user) && is_object($user) ? $user->email : ''; ?> ">

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" required value="<?=isset($user) && is_object($user) ? $user->telefono : ''; ?>">

        <label for="password">Contraseña</label>
        <input type="password" name="password" >

        <input type="submit" value="Guardar">
    </form>
</div>