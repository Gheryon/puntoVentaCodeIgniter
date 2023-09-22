<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <?php \Config\Services::validation()->listErrors();?>
      <form method="POST" action="<?php echo base_url();?>Productos/actualizar" autocomplete="off">
      <?php csrf_field();?>
      <input type="hidden" id="id" name="id" value="<?php echo $producto['id'];?>">
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="codigo">Código</label>
            <input type="text" value="<?php echo $producto['codigo'];?>"class="form-control" id="codigo" name="codigo" autofocus required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="nombre">Nombre</label>
            <input type="text" value="<?php echo $producto['nombre'];?>"class="form-control" id="nombre" name="nombre" required/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="precio_venta">Precio venta</label>
            <input type="text" value="<?php echo $producto['precio_venta'];?>"class="form-control" id="precio_venta" name="precio_venta"  required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="precio_compra">Precio compra</label>
            <input type="text" value="<?php echo $producto['precio_compra'];?>"class="form-control" id="precio_compra" name="precio_compra"  required/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="id_unidad">Unidad</label>
            <select class="form-control" id="id_unidad" name="id_unidad" required>
              <option value="">Seleccionar unidad</option>
              <?php foreach ($unidades as $unidad) {?>
                <option value="<?php echo $unidad['id'];?>" <?php if($unidad['id']==$producto['id_unidad']){echo 'selected';} ?>><?php echo $unidad['nombre'];?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="col-12 col-sm-6">
            <label for="id_categoria">Categorías</label>
            <select class="form-control" id="id_categoria" name="id_categoria" required>
              <option value="">Seleccionar categoría</option>
              <?php foreach ($categorias as $categoria) {?>
                <option value="<?php echo $categoria['id'];?>"<?php if($categoria['id']==$producto['id_categoria']){echo 'selected';} ?>><?php echo $categoria['nombre'];?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="stock">Stock mínimo</label>
            <input type="text" value="<?php echo $producto['stock_minimo'];?>"class="form-control" id="stock" name="stock" required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="inventariable">¿Es inventariable?</label>
            <select class="form-control" id="inventariable" name="inventariable">
              <option value="1" <?php if(1==$producto['inventariable']){echo 'selected';} ?>>Si</option>
              <option value="0" <?php if(0==$producto['inventariable']){echo 'selected';} ?>>No</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
        <div class="col-12 col-sm-6">
          <label for="Logotipo">Logotipo</label><br />
          <img src="<?php echo base_url().'images/productos/'.$producto['id'].'.png';?>" class="img-responsive" width="200"/>
          <input type="file" id="img_producto" name="img_producto" accept="image/png"/>
        </div>
        </div>
      </div>

        <a href="<?php echo base_url();?>Productos/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </form>
    </div>
  </main>