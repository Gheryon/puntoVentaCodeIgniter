<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <div>
        <p><a href="<?php echo base_url(); ?>Clientes/nuevo" class="btn btn-info">Añadir</a>
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="datatablesSimple">
          <thead>
            <tr>
              <<th>Id</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Teléfono</th>
              <th>Correo</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datos as $dato) { ?>
              <tr>
              <td><?php echo $dato['id']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td><?php echo $dato['direccion']; ?></td>
                <td><?php echo $dato['telefono']; ?></td>
                <td><?php echo $dato['correo']; ?></td>
                <td><a href="#" data-href="<?php echo base_url().'Clientes/reinsertar/'.$dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirmar" data-placement="top" title="Reinsertar registro" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-up"></i></a></td>
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