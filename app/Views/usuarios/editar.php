<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>

      <?php if(isset($validation)){?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors();?>
        </div>
      <?php } ?>
      
      <form method="POST" action="<?php echo base_url();?>Usuarios/actualizar" autocomplete="off">
      <?php csrf_field();?>
      <input type="hidden" id="id" name="id" value="<?php echo $usuario['id'];?>">
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario'];?>" autofocus required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre'];?>" required/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="id_caja">Caja</label>
            <select class="form-control" id="id_caja" name="id_caja" required>
              <option value="">Seleccionar caja</option>
              <?php foreach ($cajas as $caja) {?>
                <option value="<?php echo $caja['id'];?>"<?php if($caja['id']==$usuario['id_caja']){echo 'selected';} ?>><?php echo $caja['nombre'];?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="col-12 col-sm-6">
            <label for="id_rol">Roles</label>
            <select class="form-control" id="id_rol" name="id_rol" required>
              <option value="">Seleccionar rol</option>
              <?php foreach ($roles as $rol) {?>
                <option value="<?php echo $rol['id'];?>" <?php if($rol['id']==$usuario['id_rol']){echo 'selected';} ?>><?php echo $rol['nombre'];?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
      </div>
        <a href="<?php echo base_url();?>Usuarios/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </form>
    </div>
  </main>