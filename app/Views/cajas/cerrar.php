<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      
      <?php if(isset($validation)){?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors();?>
        </div>
      <?php } ?>

      <form method="POST" action="<?php echo base_url();?>Cajas/cerrar" autocomplete="off">
      <?php csrf_field();?>
      <input id="id_arqueo" name="id_arqueo" type="hidden" value="<?php echo $arqueo['id'];?>"/>
      <div class="form-group">
        <div class="row">
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
          </div>
          
          <div class="row">
            <div class="col-12 col-sm-6">
              <label for="monto_inicial">Monto inicial</label>
              <input type="text" class="form-control" id="monto_inicial" name="monto_inicial"  value="<?php echo $arqueo['monto_inicial'];?>" required/>
            </div>
            <div class="col-12 col-sm-6">
              <label for="monto_final">Monto final</label>
              <input type="text" class="form-control" id="monto_final" name="monto_final"  value="<?php //echo $caja['monto_final'];?>" required/>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6">
              <label for="fecha">Fecha</label>
              <input type="date" class="form-control" id="fecha" name="fecha"  value="<?php echo date('Y-m-d')?>" required/>
            </div>
            <div class="col-12 col-sm-6">
              <label for="hora">Hora</label>
              <input type="text" class="form-control" id="hora" name="hora"  value="<?php echo date('H:i:s')?>" required/>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-6">
              <label for="total_ventas">Monto de ventas</label>
              <input type="text" class="form-control" id="total_ventas" name="total_ventas"  value="<?php echo $monto['total'];?>" required/>
            </div>
            <div class="col-12 col-sm-6">
              <label for="no_ventas">Total de ventas</label>
              <input type="text" class="form-control" id="no_ventas" name="no_ventas"  value="" required/>
            </div>
          </div>
        </div>
      </div>
        <a href="<?php echo base_url();?>Cajas/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </form>
    </div>
  </main>