<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <div>
          <a href="<?php echo base_url(); ?>Unidades/eliminados" class="btn btn-warning">Eliminados</a>
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="datatablesSimple">
          <thead>
            <tr>
              <th>Id</th>
              <th>Folio</th>
              <th>Total</th>
              <th>Fecha</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($compras as $compra) { ?>
              <tr>
                <td><?php echo $compra['id']; ?></td>
                <td><?php echo $compra['codigo']; ?></td>
                <td><?php echo $compra['total']; ?></td>
                <td><?php echo $compra['fecha_alta']; ?></td>
                <td><a href="<?php echo base_url().'Compras/ver_compra_pdf/'.$compra['id']; ?>" class="btn btn-primary"><i class="fas fa-file-alt"></i></a></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
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