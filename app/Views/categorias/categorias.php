<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <div>
        <p><a href="<?php echo base_url(); ?>Categorias/nuevo" class="btn btn-info">Añadir</a>
          <a href="<?php echo base_url(); ?>Categorias/eliminados" class="btn btn-warning">Eliminados</a>
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="datatablesSimple">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datos as $dato) { ?>
              <tr>
                <td><?php echo $dato['id']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td><a href="<?php echo base_url().'Categorias/editar/'.$dato['id']; ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a></td>
                <td><a href="<?php echo base_url().'Categorias/eliminar/'.$dato['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>