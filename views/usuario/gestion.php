<h1>Gestión de usuarios</h1>
<a href="<?=base_url?>usuario/registro" class="button button-small"> Crear usuario</a>

<table>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Teléfono</th>
    </tr>
    <?php while($usuario = $usuarios->fetch_object()): ?>
        <tr>
            <td><?=$usuario->nombre;?></td>
            <td><?=$usuario->apellidos?></td>
            <td><?=$usuario->email?></td>
            <td><?=$usuario->telefono?></td>
            <td>
                <a href="<?=base_url?>usuario/editar&id=<?=$usuario->id?>" class="button button-gestion">Editar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>