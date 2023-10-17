<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      
      <?php if(isset($validation)){?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors();?>
        </div>
      <?php } ?>

      <form method="POST" action="<?php echo base_url();?>Cajas/nuevo_arqueo" autocomplete="off">
      <?php csrf_field();?>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="numero_caja">Número de caja</label>
            <input type="text" class="form-control" id="numero_caja" name="numero_caja"  value="<?php echo $caja['numero_caja'];?>" autofocus required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"  value="<?php echo $session->nombre;
            ?>" required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="monto_inicial">Monto inicial</label>
            <input type="text" class="form-control" id="monto_inicial" name="monto_inicial"  value="" required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="folio_inicial">Folio inicial</label>
            <input type="text" class="form-control" id="folio_inicial" name="folio_inicial"  value="<?php echo $caja['codigo'];?>" required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha"  value="<?php echo date('Y-m-d')?>" required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="hora">Hora</label>
            <input type="text" class="form-control" id="hora" name="hora"  value="<?php echo date('H:i:s')?>" required/>
          </div>
        </div>
      </div>
        <a href="<?php echo base_url();?>Cajas/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </form>
    </div>
  </main>