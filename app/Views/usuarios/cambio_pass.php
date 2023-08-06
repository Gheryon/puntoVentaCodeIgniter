<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>

      <?php if(isset($validation)){?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors();?>
        </div>
      <?php } ?>

      <form method="POST" action="<?php echo base_url();?>Usuarios/actualizarPassword" autocomplete="off">
      <?php csrf_field();?>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="codigo">Nombre de usuario</label>
            <input type="text" value="<?php echo $usuario['usuario'];?>"class="form-control" id="codigo" name="codigo" disabled/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="nombre">Nombre</label>
            <input type="text" value="<?php echo $usuario['nombre'];?>"class="form-control" id="nombre" name="nombre" disabled/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="repassword">Confirma contraseña</label>
            <input type="password" class="form-control" id="repassword" name="repassword" required/>
          </div>
        </div>
      </div>
        <a href="<?php echo base_url();?>Usuarios/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>

        <?php if(isset($mensaje)){?>
        <div class="alert alert-success">
          <?php echo $mensaje;?>
        </div>
      <?php } ?>
      </form>
    </div>
  </main>