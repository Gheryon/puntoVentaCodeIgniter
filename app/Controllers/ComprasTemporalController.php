<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ComprasTemporalModel;
use App\Models\ProductosModel;

class ComprasTemporalController extends BaseController{
  protected $temporal_compras, $productos;

  public function __construct()
  {
    $this->temporal_compras=new ComprasTemporalModel();
    $this->productos=new ProductosModel();
  }

  public function insertar($id_producto, $cantidad, $id_compra){
    $error='';
    $producto=$this->productos->where('id', $id_producto)->first();
    if($producto){
      $existe=$this->temporal_compras->porIdProductoCompra($id_producto, $id_compra);
      if($existe){
        $cantidad=$existe->cantidad+$cantidad;
        $subtotal=$cantidad*$existe->precio;
        $this->temporal_compras->actualizarProductoCompra($id_producto, $id_compra, $cantidad, $subtotal);
      }else{
        $subtotal=$cantidad*$producto['precio_compra'];
        $this->temporal_compras->save([
          'folio'=>$id_compra,
          'id_producto'=>$id_producto,
          'codigo'=>$producto['codigo'],
          'nombre'=>$producto['nombre'],
          'precio'=>$producto['precio_compra'],
          'cantidad'=>$cantidad,
          'subtotal'=>$subtotal
        ]);
      }
    }else{
      $error='No existe el producto.';
    }
    $res['datos']=$this->cargaProductos($id_compra);
    $res['total']=number_format($this->totalProductos($id_compra), 2,'.',',');
    $res['error']=$error;
    echo json_encode($res);
  }

  public function cargaProductos($id_compra){
    $resultado=$this->temporal_compras->porCompra($id_compra);
    $fila='';
    $numFila=0;
    foreach ($resultado as $row) {
      $numFila++;
      $fila.="<tr id='fila".$numFila."'>";
      $fila.="<td>".$numFila."</td>";
      $fila.="<td>".$row['codigo']."</td>";
      $fila.="<td>".$row['nombre']."</td>";
      $fila.="<td>".$row['precio']."</td>";
      $fila.="<td>".$row['cantidad']."</td>";
      $fila.="<td>".$row['subtotal']."</td>";
      $fila.="<td><a onclick=\"eliminaProducto(".$row['id_producto'].", '".$id_compra."')\" class='borrar'><span class='fas fa-fw fa-trash'></span></a></td>";
      $fila.="</tr>";
    }
    return $fila;
  }

  public function totalProductos($id_compra){
    $resultado=$this->temporal_compras->porCompra($id_compra);
    $total=0;
    foreach ($resultado as $row) {
      $total+=$row['subtotal']      ;
    }
    return $total;
  }

  public function eliminar($id_producto, $id_compra){
    $existe=$this->temporal_compras->porIdProductoCompra($id_producto, $id_compra);
    if($existe){
      if($existe->cantidad>1){
        $cantidad=$existe->cantidad-1;
        $subtotal=$cantidad*$existe->precio;
        $this->temporal_compras->actualizarProductoCompra($id_producto, $id_compra, $cantidad, $subtotal);
      }else{
        $this->temporal_compras->eliminarProductoCompra($id_producto, $id_compra);
      }
    }
    
    $res['datos']=$this->cargaProductos($id_compra);
    $res['total']=number_format($this->totalProductos($id_compra), 2,'.',',');
    $res['error']='';
    echo json_encode($res);
  }
}
?>