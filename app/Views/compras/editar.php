<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>

      <?php if(isset($validation)){?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors();?>
        </div>
      <?php } ?>
      
      <form method="POST" action="<?php echo base_url();?>Unidades/actualizar" autocomplete="off">
      <div class="form-group">
        <input type="hidden" value="<?php echo $datos['id']; ?>" name="id">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos['nombre'];?>" autofocus required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="nombre_corto">Nombre corto</label>
            <input type="text" class="form-control" id="nombre_corto" name="nombre_corto"  value="<?php echo $datos['nombre_corto']; ?>" required/>
          </div>
        </div>
      </div>
        <a href="<?php echo base_url();?>Unidades/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </form>
    </div>
  </main>