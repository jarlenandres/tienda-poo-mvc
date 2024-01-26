<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    <h1>Editar producto <?=$pro->nombre?></h1>
    <?php $url_action = base_url."producto/save&id=".$pro->id; ?>
<?php else: ?>
    <h1>Crear producto</h1>
    <?php $url_action = base_url."producto/save"; ?>
<?php endif; ?>

<div class="form_container">
    <form action="<?=$url_action?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>">

        <label for="descripcion">descripción</label>
        <textarea name="descripcion" id="" cols="80" rows="5"><?= isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>

        <label for="precio">precio</label>
        <input type="text" name="precio" required value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''; ?>">

        <label for="stock">stock</label>
        <input type="number" name="stock" required value="<?= isset($pro) && is_object($pro) ? $pro->stock : ''; ?>">

        <label for="categoria">categoria</label>
        <?php $categorias = Utils::showCategorias(); ?>
        <select name="categoria" id="">
            <?php while($cat = $categorias->fetch_object()): ?>
            <option value="<?=$cat->id?>" <?= isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : ''; ?>>
                <?=$cat->nombre?>
            </option>
            <?php endwhile;?>
        </select>
        
        <label for="imagen">imagen</label>
        <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)) :?>
            <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="" class="thumb">
        <?php endif; ?>
        <input type="file" name="imagen">

        <input type="submit" value="Guardar">
    </form>
</div>