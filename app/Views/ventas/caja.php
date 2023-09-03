<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">

    <?php $idVentaTmp=uniqid();?>
    <br>

    <form id="form_venta" name="form_venta" class="form-horizontal" method="POST" action="<?php echo base_url();?>Ventas/guarda" autocomplete="off">
      <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $idVentaTmp;?>">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6">
            <div class="ui-widget">
              <label>Cliente: </label>
              <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Nombre del cliente" value="Público en general" autocomplete="off" required/>
              <input type="hidden" id="id_cliente" name="id_cliente" value="1"/>
            </div>
          </div>
          <div class="col-sm-6">
            <label>Forma de pago: </label>
            <select id="forma_pago" name="forma_pago" class="form-select" required>
              <option value="001">Efectivo</option>
              <option value="002">Tarjeta</option>
              <option value="003">Transferencia</option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group mt-2">
        <div class="row">
          <div class="col-12 col-sm-4">
            <input type="hidden" id="id_producto" name="id_producto"/>
            <label for="codigo">Código de barras</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Introduzca código" onkeyup="agregarProductoTabla(event, this.value, 1, <?php echo $idVentaTmp;?>)" autofocus/>
          </div>
          <div class="col-sm-2">
            <label for="codigo" id="resultado_error" style="color:red"></label>
          </div>
          <div class="col-12 col-sm-4">
            <label style="font-weight: bold; font-size: 30px; text-align: center;" for="">Total $</label>
            <input type="text" name="total" id="total" size="7" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;"/>
          </div>
        </div>
      </div>

      <div class="form-group">
        <button type="button" id="completa_venta" name="completa_venta" class="btn btn-success">Completar venta</button>
      </div>
      <div class="row">
        <table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos" width="100$%">
          <thead class="thead-dark">
            <th>#</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th width="1%"></th>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </form>
    </div>
  </main>

<script>
  $(function(){
    $('#cliente').autocomplete({
      source: "<?php echo base_url();?>Clientes/autocompleteData",
      minLength: 3,
      select: function (event, ui){
        event.preventDefault();
        $('#id_cliente').val(ui.item.id);
        $('#cliente').val(ui.item.value);
      }
    });
  });

  $(function(){
    $('#codigo').autocomplete({
      source: "<?php echo base_url();?>Productos/autocompleteData",
      minLength: 1,
      select: function (event, ui){
        event.preventDefault();
        $('#codigo').val(ui.item.value);
        setTimeout(
          function(){
            e=jQuery.Event("keypress");
            e.which=13;//presionar la tecla 13, la de enter
            agregarProductoTabla(e, ui.item.id, 1, '<?php echo $idVentaTmp;?>');
          }
        )
      }
    });
  });

  function agregarProductoTabla(e, id_producto, cantidad, id_venta){
    let enterKey=13;
    if(codigo!=''){
      if(e.which==enterKey){
    if(id_producto!=null&&id_producto!=0&&cantidad>0){
      $.ajax({
        url: '<?php echo base_url();?>ComprasTemporal/insertar/'+id_producto+'/'+cantidad+'/'+id_venta,
        //dataType: 'json',
        success: function(resultado){
          if(resultado==0){
            
          }else{
            var resultado=JSON.parse(resultado);
            if(resultado.error==''){
              $('#tablaProductos tbody').empty();//limpia el tbody de datos
              $('#tablaProductos tbody').append(resultado.datos);
              $('#total').val(resultado.total);
              $('#id_producto').val('');
              $('#codigo').val('');
              $('#nombre').val('');
              $('#cantidad').val('');
              $('#precio_compra').val('');
              $('#subtotal').val('');
            }
          }
        }
      });
    }
      }
    }
  }

  function eliminaProducto(id_producto, id_venta){
    $.ajax({
      url: '<?php echo base_url();?>ComprasTemporal/eliminar/'+id_producto+'/'+id_venta,
      success: function(resultado){
        if(resultado==0){
          $(tagCodigo).val('');
        }else{
          var resultado=JSON.parse(resultado);
          if(resultado.error==''){
            $('#tablaProductos tbody').empty();//limpia el tbody de datos
            $('#tablaProductos tbody').append(resultado.datos);
            $('#total').val(resultado.total);
          }
        }
      }
    });
  }

  $(function(){
    $("#completa_venta").click(function(){
      let nFilas=$("#tablaProductos tr").length;
      if(nFilas<2){
        alert("Hay que añadir un producto al menos.")
      }else{
        $("#form_venta").submit();
      }
    });
  });
</script>