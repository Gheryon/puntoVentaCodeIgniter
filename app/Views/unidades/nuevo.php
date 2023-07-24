<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <form method="POST" action="<?php echo base_url();?>Unidades/insertar" autocomplete="off">
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" autofocus required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="nombre_corto">Nombre corto</label>
            <input type="text" class="form-control" id="nombre_corto" name="nombre_corto"  required/>
          </div>
        </div>
      </div>
        <a href="<?php echo base_url();?>Unidades/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </form>
    </div>
  </main>