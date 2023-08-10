<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\ComprasTemporalModel;
use App\Models\DetalleCompraModel;
use App\Models\ProductosModel;

class ComprasController extends BaseController{
  protected $compras, $compras_temporal, $detalle_compra, $productos;
  protected $reglas;

  public function __construct()
  {
    $this->compras=new ComprasModel();
    $this->detalle_compra=new DetalleCompraModel();
    helper(['form']);
  }

  public function index($activo=1){
    $compras=$this->compras->where('activo', $activo)->findAll();
    $data=['titulo'=>'Compras', 'datos'=>$compras];
    echo view('header');
    echo view('compras/compras', $data);
    echo view('footer');
  }

  public function eliminados($activo=0){
    $compras=$this->compras->where('activo', $activo)->findAll();
    $data=['titulo'=>'Compras eliminadas', 'datos'=>$compras];
    echo view('header');
    echo view('compras/eliminados', $data);
    echo view('footer');
  }

  public function nuevo(){
    echo view('header');
    echo view('compras/nuevo');
    echo view('footer');
  }

  public function guardar(){
    $id_compra=$this->request->getPost('id_compra');
    $total=$this->request->getPost('total');
    $session=session();
    $resultado_id=$this->compras->insertarCompra($id_compra, $total, $session->id_usuario);
    
    if($resultado_id){
      $this->compras_temporal=new ComprasTemporalModel();
      $resultadoCompra=$this->compras_temporal->porCompra($id_compra);
      foreach($resultadoCompra as $row){
        $this->detalle_compra->save([
          'id_compra'=>$resultado_id,
          'id_producto'=>$row['id_producto'],
          'nombre'=>$row['nombre'],
          'cantidad'=>$row['cantidad'],
          'precio'=>$row['precio']
        ]);
        $this->productos=new ProductosModel();
        $this->productos->actualizarStock($row['id_producto'], $row['cantidad']);
      }
      $this->compras_temporal->eliminarCompra($id_compra);
      return redirect()->to(base_url()."Productos");
    }
  }
  
}
?>