<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <br/>
      <div class="row">
        <div class="col-4">
          <div class="card text-white bg-primary">
            <div class="card-body">
              Total de productos en el sistema:
              <?php echo $total;?>
            </div>
            <div class="card-footer">
              <a class="text-white" href="<?php echo base_url() ?>/Productos">Ver detalles</a>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card text-white bg-success">
            <div class="card-body">
              Total de ventas en el día:
              <?php echo $total_ventas['total'];?>
            </div>
            <div class="card-footer">
              <a class="text-white" href="<?php echo base_url() ?>/Ventas">Ver detalles</a>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card text-white bg-danger">
            <div class="card-body">
              Total de productos con stock mínimo:
              <?php echo $minimos;?>
            </div>
            <div class="card-footer">
              <a class="text-white" href="<?php echo base_url() ?>/Productos/mostrarMinimos">Ver detalles</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>