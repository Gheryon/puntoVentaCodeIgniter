<footer class="py-4 bg-light mt-auto">
  <div class="container-fluid px-4">
    <div class="d-flex align-items-center justify-content-between small">
      <div class="text-muted">Copyright &copy; Prueba codeigniter <?php echo date('Y');?></div>
      <div>
        <a href="#">Política de privacidad</a>
        &middot;
        <a href="#">Términos &amp; condiciones</a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>
<script src="<?php echo base_url();?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>js/scripts.js"></script>
<script src="<?php echo base_url();?>js/simple-datatables.min.js"></script>
<script src="<?php echo base_url();?>js/datatables-simple-demo.js"></script>
<script>
  var myModal = document.getElementById('modal-confirmar');
  myModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget
    //recoge lo que hay en data-href dentro del boton presionado para abrir el modal
    var href_modal = button.getAttribute('data-href');
    //reemplaza el href del boton de confirmar con el href anterior
    var btnok = document.getElementById('btn-ok').setAttribute('href', href_modal);
});
</script>
</body>

</html>