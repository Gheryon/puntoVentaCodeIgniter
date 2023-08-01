<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      
      <?php if(isset($validation)){?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors();?>
        </div>
      <?php } ?>

      <form method="POST" action="<?php echo base_url();?>Clientes/insertar" autocomplete="off">
      <?php csrf_field();?>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo set_value('nombre')?>" autofocus required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo set_value('direccion')?>"/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
        <div class="col-12 col-sm-6">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo set_value('telefono')?>"/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="correo">Correo electrónico</label>
            <input type="text" class="form-control" id="correo" name="correo" value="<?php echo set_value('correo')?>"/>
          </div>
        </div>
      </div>
        <a href="<?php echo base_url();?>Clientes/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </form>
    </div>
  </main>