<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;
use App\Models\UnidadesModel;
use App\Models\DetalleRolesPermisosModel;

class Productos extends BaseController{
  protected $productos, $detalleRoles, $session;
  protected $unidades;
  protected $categorias;
  protected $reglas;
  
  public function __construct()
  {
    $this->productos=new ProductosModel();
    $this->unidades=new UnidadesModel();
    $this->categorias=new CategoriasModel();
    $this->detalleRoles=new DetalleRolesPermisosModel();
    $this->session=session();

    helper(['form']);
    $this->reglas=[
      'codigo'=> [
        'rules'=>'required|is_unique[productos.codigo]', 
        'errors'=>[
          'required'=>'El campo {field} es obligatorio.',
          'is_unique'=>'El campo {field} ya existe en el sistema.'
          ]
        ],
      'nombre'=> [
        'rules'=>'required', 
        'errors'=>[
          'required'=>'El campo {field} es obligatorio.'
          ]
        ]
      ];
  }

  public function index($activo=1){
    $permiso=$this->detalleRoles->verificaPermisos($this->session->id_rol, 'ProductosCatalogo');
    if(!$permiso){
      echo 'No tiene permiso';
    }else{
      $productos=$this->productos->where('activo', $activo)->findAll();
      $data=['titulo'=>'Productos', 'datos'=>$productos];
      echo view('header');
      echo view('productos/productos', $data);
      echo view('footer');
    }
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
    if($this->request->getMethod()=="post"&&$this->validate($this->reglas)){
      $this->productos->save(['codigo'=>$this->request->getPost('codigo'),'nombre'=>$this->request->getPost('nombre'),
      'precio_venta'=>$this->request->getPost('precio_venta'),
      'precio_compra'=>$this->request->getPost('precio_compra'),
      'stock_minimo'=>$this->request->getPost('stock'),
      'inventariable'=>$this->request->getPost('inventariable'),
      'id_unidad'=>$this->request->getPost('id_unidad'),
      'id_categoria'=>$this->request->getPost('id_categoria')]);


      $validacion=$this->validate([
        'img_producto' => [
          'uploaded[img_producto]',
          'mime_in[img_producto,image/png,image/jpeg,image/jpg]',
          'max_size[img_producto, 4096]'
        ]
      ]);

      if($validacion){
        $id=$this->productos->insertID();
        $ruta_logo="images/productos/".$id.".png";
        if(file_exists($ruta_logo)){
          unlink($ruta_logo);
        }
        $logo=$this->request->getFile('img_producto');
        $logo->move('./images/productos/', $id.'.png');
      }else{
        echo 'Error en la validacion';
        exit;
      }
      return redirect()->to(base_url().'/Productos');
    }else{
      $unidades=$this->unidades->where('activo', 1)->findAll();
      $categorias=$this->categorias->where('activo', 1)->findAll();
      $data=['titulo'=>'Añadir producto', 'unidades'=>$unidades, 'categorias'=>$categorias, 'validation'=>$this->validator];
      //$data=['titulo'=>'Añadir unidad', 'validation'=>$this->validator];
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

  public function buscar_por_codigo($codigo){
    $res['existe']=false;
    $res['datos']='';
    $res['error']='';
    $this->productos->select('*');
    $this->productos->where('codigo', $codigo);
    $this->productos->where('activo', 1);
    $datos=$this->productos->get()->getRow();

    if($datos){
      $res['datos']=$datos;
      $res['existe']=true;
    }else{
      $res['error']='No existe el producto';
    }
    echo json_encode($res);
  }

  public function autocompleteData(){
    $returnData=array();
    $valor=$this->request->getGet('term');
    $productos=$this->productos->like('codigo', $valor)->where('activo', 1)->findAll();
    if(!empty($productos)){
      foreach ($productos as $row) {
        $data['id']=$row['id'];
        $data['value']=$row['codigo'];
        $data['label']=$row['codigo'].'-'.$row['nombre'];
        array_push($returnData, $data);
      }
    }
    echo json_encode($returnData);
  }

  public function generarCodigoBarras(){
    $pdf=new \FPDF('P', 'mm', 'letter');
    $pdf->AddPage();
    $pdf->SetMargins(10,10,10);
    $pdf->SetTitle("Códigos de barras");

    $productos=$this->productos->where('activo', 1)->findAll();

    foreach ($productos as $producto) {
      $codigo=$producto['codigo'];
      $generaBarcode=new \barcode_genera();
      $generaBarcode->barcode("images/barcode/".$codigo.".png", $codigo, 20, "horizontal", "code39", true);
      $pdf->Image("images/barcode/".$codigo.".png");
      //unlink("images/barcode/".$codigo.".png");
    }
    $this->response->setHeader('Content-Type', 'application/pdf');
    $pdf->Output('Codigos.pdf', 'I');
  }

  function muestraCodigos(){
    echo view('header');
    echo view('Productos/ver_codigos');
    echo view('footer');
  }

  public function generarMinimosPdf(){
    $pdf=new \FPDF('P', 'mm', 'letter');
    $pdf->AddPage();
    $pdf->SetMargins(10,10,10);
    $pdf->SetTitle(utf8_decode("Productos con stock mínimo"));

    $pdf->SetFont("Arial", 'B', 10);
    $pdf->Image("images/logotipo.png", 10, 5, 25);

    $pdf->Cell(0, 5, utf8_decode("Reporte de productos con stock mínimo."), 0, 1, 'C');

    $pdf->Ln(20);
    $pdf->Cell(40, 5, utf8_decode("Código"), 1, 0, 'C');
    $pdf->Cell(80, 5, utf8_decode("Nombre"), 1, 0, 'C');
    $pdf->Cell(30, 5, utf8_decode("Existencias"), 1, 0, 'C');
    $pdf->Cell(30, 5, utf8_decode("Mínimo"), 1, 1, 'C');
    
    $productos=$this->productos->getProductosMinimo();

    foreach ($productos as $producto) {
      $pdf->Cell(40, 5, $producto['codigo'], 1, 0, 'C');
      $pdf->Cell(80, 5, $producto['nombre'], 1, 0, 'C');
      $pdf->Cell(30, 5, $producto['existencias'], 1, 0, 'C');
      $pdf->Cell(30, 5, $producto['stock_minimo'], 1, 1, 'C');
    }

    $this->response->setHeader('Content-Type', 'application/pdf');
    $pdf->Output('productosMinimos.pdf', 'I');
  }

  function muestraMinimos(){
    echo view('header');
    echo view('Productos/ver_minimos');
    echo view('footer');
  }
}
?>