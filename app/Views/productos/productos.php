<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <div>
        <p><a href="<?php echo base_url(); ?>Productos/nuevo" class="btn btn-info">Añadir</a>
          <a href="<?php echo base_url(); ?>Productos/eliminados" class="btn btn-warning">Eliminados</a>
          <a href="<?php echo base_url(); ?>Productos/muestraCodigos" class="btn btn-primary">Códigos de barras</a>
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="datatablesSimple">
          <thead>
            <tr>
              <th>Id</th>
              <th>Código</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Existencias</th>
              <th>Imagen</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datos as $dato) { ?>
              <tr>
                <td><?php echo $dato['id']; ?></td>
                <td><?php echo $dato['codigo']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td><?php echo $dato['precio_venta']; ?></td>
                <td><?php echo $dato['existencias']; ?></td>
                <td><img src="<?php echo base_url().'images/productos/'.$dato['id'].'.png';?>" width="100" /></td>
                <td><a href="<?php echo base_url().'Productos/editar/'.$dato['id']; ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a></td>
                <td><a href="#" data-href="<?php echo base_url().'Productos/eliminar/'.$dato['id']; ?>" data-bs-toggle="modal" data-bs-target="#modal-confirmar" data-placement="top" title="Eliminar registro" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
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