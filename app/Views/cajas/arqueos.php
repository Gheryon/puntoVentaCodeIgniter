<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <div>
        <p><a href="<?php echo base_url(); ?>Cajas/nuevo_arqueo" class="btn btn-info">Añadir</a>
          <a href="<?php echo base_url(); ?>Cajas/eliminados" class="btn btn-warning">Eliminados</a>
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="datatablesSimple">
          <thead>
            <tr>
              <th>Id</th>
              <th>Fecha apertura</th>
              <th>Fecha cierre</th>
              <th>Monto inicial</th>
              <th>Monto final</th>
              <th>Total ventas</th>
              <th>Estatus</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datos as $dato) { ?>
              <tr>
                <td><?php echo $dato['id']; ?></td>
                <td><?php echo $dato['fecha_inicio']; ?></td>
                <td><?php echo $dato['fecha_fin']; ?></td>
                <td><?php echo $dato['monto_inicial']; ?></td>
                <td><?php echo $dato['monto_final']; ?></td>
                <td><?php echo $dato['total_ventas']; ?></td>
                <?php if($dato['estatus']==1){?>
                  <td>Abierta</td>
                  <td><a href="#" data-href="<?php echo base_url().'/Cajas/cerrar/'.$dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirmar" data-placement="top" title="Eliminar registro" class="btn btn-danger"><i class="fas fa-lock"></i></a></td>
                <?php }else{?>
                  <td>Cerrada</td>
                  <td><a href="#" data-href="<?php echo base_url().'/Cajas/eliminar/'.$dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#add-new" data-placement="top" title="Eliminar registro" class="btn btn-success"><i class="fas fa-print"></i></a></td>  
                <?php } ?>
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
          <h5 class="modal-title" id="exampleModalLabel">Cerrar caja</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>¿Seguro de cerrar la caja?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a id="btn-ok" class="btn btn-danger btn-ok">Eliminar</a>
        </div>
      </div>
    </div>
  </div>