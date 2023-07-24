<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;
use App\Models\UnidadesModel;

class Productos extends BaseController{
  protected $productos;
  protected $unidades;
  protected $categorias;
  
  public function __construct()
  {
    $this->productos=new ProductosModel();
    $this->unidades=new UnidadesModel();
    $this->categorias=new CategoriasModel();
  }

  public function index($activo=1){
    $productos=$this->productos->where('activo', $activo)->findAll();
    $data=['titulo'=>'Productos', 'datos'=>$productos];
    echo view('header');
    echo view('productos/productos', $data);
    echo view('footer');
  }

  public function eliminados($activo=0){
    $productos=$this->productos->where('activo', $activo)->findAll();
    $data=['titulo'=>'Productos eliminados', 'datos'=>$productos];
    echo view('header');
    echo view('productos/eliminados', $data);
    echo view('footer');
  }

  public function nuevo(){
    $unidades=$this->unidades->where('activo', 1)->findAll();
    $categorias=$this->categorias->where('activo', 1)->findAll();
    $data=['titulo'=>'Añadir producto', 'unidades'=>$unidades, 'categorias'=>$categorias];
    echo view('header');
    echo view('productos/nuevo', $data);
    echo view('footer');
  }

  public function insertar(){
    if($this->request->getMethod()=="post"){
      $this->productos->save(['codigo'=>$this->request->getPost('codigo'),'nombre'=>$this->request->getPost('nombre'),
      'precio_venta'=>$this->request->getPost('precio_venta'),
      'precio_compra'=>$this->request->getPost('precio_compra'),
      'stock_minimo'=>$this->request->getPost('stock'),
      'inventariable'=>$this->request->getPost('inventariable'),
      'id_unidad'=>$this->request->getPost('id_unidad'),
      'id_categoria'=>$this->request->getPost('id_categoria')]);
      return redirect()->to(base_url().'/Productos');
    }else{
      $data=['titulo'=>'Añadir unidad', 'validation'=>$this->validator];
      echo view('header');
      echo view('productos/nuevo', $data);
      echo view('footer');
    }
  }

  public function editar($id){
    $unidades=$this->unidades->where('activo', 1)->findAll();
    $categorias=$this->categorias->where('activo', 1)->findAll();
    $producto=$this->productos->where('id', $id)->first();
    $data=['titulo'=>'Editar producto', 'producto'=>$producto, 'unidades'=>$unidades, 'categorias'=>$categorias];
    echo view('header');
    echo view('productos/editar', $data);
    echo view('footer');
  }

  public function actualizar(){
    $this->productos->update($this->request->getPost('id'), ['codigo'=>$this->request->getPost('codigo'),'nombre'=>$this->request->getPost('nombre'),
    'precio_venta'=>$this->request->getPost('precio_venta'),
    'precio_compra'=>$this->request->getPost('precio_compra'),
    'stock_minimo'=>$this->request->getPost('stock'),
    'inventariable'=>$this->request->getPost('inventariable'),
    'id_unidad'=>$this->request->getPost('id_unidad'),
    'id_categoria'=>$this->request->getPost('id_categoria')]);
    return redirect()->to(base_url().'/Productos');
  }

  public function eliminar($id){
    $this->productos->update($id, ['activo'=>0]);
    return redirect()->to(base_url().'/Productos');
  }

  public function reinsertar($id){
    $this->productos->update($id, ['activo'=>1]);
    return redirect()->to(base_url().'/Productos');
  }
}
?>