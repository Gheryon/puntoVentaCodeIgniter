<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4"><?php echo $titulo; ?></h1>

      <form id="form_permisos" name="form_permisos" method="POST" action="<?php echo base_url().'Roles/guardarPermisos';?>">
      <input type="hidden" name="id_rol" value="<?php echo $id_rol;?>"/>
      <?php
      foreach ($permisos as $permiso) {?>
        <input type="checkbox" value="<?php echo $permiso['id'];?>" name="permisos[]" <?php if(isset($asignado[$permiso['id']])){ echo 'checked';}?>/> <label> <?php echo $permiso['nombre']; ?></label><br/>
      <?php
      }
      ?>
      <button type="submit" class="btn btn-primary">Guardar</button>
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