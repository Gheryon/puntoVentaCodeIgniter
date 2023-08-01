<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <?php if(isset($validation)){?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors();?>
        </div>
      <?php } ?>

      <form method="POST" action="<?php echo base_url();?>Configuracion/actualizar" autocomplete="off">
      <?php csrf_field();?>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="tienda_nombre">Nombre de la tienda</label>
            <input type="text" class="form-control" id="tienda_nombre" name="tienda_nombre" value="<?php echo $nombre['valor'];?>" autofocus required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="tienda_rfc">RFC</label>
            <input type="text" class="form-control" id="tienda_rfc" name="tienda_rfc" value="<?php echo $rfc['valor'];?>" required/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="tienda_telefono">Teléfono de la tienda</label>
            <input type="text" class="form-control" id="tienda_telefono" name="tienda_telefono" value="<?php echo $telefono['valor'];?>" required/>
          </div>
          <div class="col-12 col-sm-6">
            <label for="tienda_email">Correo de la tienda</label>
            <input type="text" class="form-control" id="tienda_email" name="tienda_email" value="<?php echo $email['valor'];?>" required/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-12 col-sm-6">
            <label for="tienda_direccion">Dirección  de la tienda</label>
            <textarea  class="form-control" id="tienda_direccion" name="tienda_direccion" required><?php echo $direccion['valor'];?></textarea>
          </div>
          <div class="col-12 col-sm-6">
            <label for="ticket_leyenda">Leyenda del ticket</label>
            <textarea  class="form-control" id="ticket_leyenda" name="ticket_leyenda" required><?php echo $leyenda['valor'];?></textarea>
          </div>
        </div>
      </div>
        <a href="<?php echo base_url();?>Configuracion/" class="btn btn-primary">Volver</a>
        <button type="submit" class="btn btn-success">Guardar</button>
      </form>
    </div>
  </main>
  
  <!-- Modal -->
  <div class="modal fade" id="modal-confirmar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>¿Seguro de eliminar registro?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a id="btn-ok" class="btn btn-danger btn-ok">Eliminar</a>
        </div>
      </div>
    </div>
  </div>