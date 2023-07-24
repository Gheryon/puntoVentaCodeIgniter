<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>
      <div>
          <a href="<?php echo base_url(); ?>Unidades" class="btn btn-warning">Unidades</a>
        </p>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="datatablesSimple">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Nombre corto</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datos as $dato) { ?>
              <tr>
                <td><?php echo $dato['id']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td><?php echo $dato['nombre_corto']; ?></td>
                <td><a href="<?php echo base_url().'Unidades/reinsertar/'.$dato['id']; ?>" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-up"></i></a></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>