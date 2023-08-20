<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\ComprasTemporalModel;
use App\Models\DetalleCompraModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionModel;

class ComprasController extends BaseController{
  protected $compras, $compras_temporal, $detalle_compra, $productos, $configuracion;
  protected $reglas;

  public function __construct()
  {
    $this->compras=new ComprasModel();
    $this->detalle_compra=new DetalleCompraModel();
    $this->configuracion=new ConfiguracionModel();
    helper(['form']);
  }

  public function index($activo=1){
    $compras=$this->compras->where('activo', $activo)->findAll();
    $data=['titulo'=>'Historial de compras', 'compras'=>$compras];
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
    $total=preg_replace('/[\$,]/', '', $this->request->getPost('total'));
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
    }
    return redirect()->to(base_url()."Compras/ver_compra_pdf/".$resultado_id);
  }

  function muestraCompraPdf($id_compra){
    $data['id_compra']=$id_compra;
    echo view('header');
    echo view('compras/ver_compra_pdf', $data);
    echo view('footer');
  }

  function generaCompraPdf($id_compra){
    $datosCompra=$this->compras->where('id', $id_compra)->first();
    $this->detalle_compra->select('*');
    $this->detalle_compra->where('id_compra', $id_compra);
    $detalleCompra=$this->detalle_compra->findAll();
    $this->configuracion->select('valor');
    $this->configuracion->where('nombre', 'tienda_nombre');
    $nombreTienda=$this->configuracion->get()->getRow()->valor;
    $this->configuracion->select('valor');
    $this->configuracion->where('nombre', 'tienda_direccion');
    $direccionTienda=$this->configuracion->get()->getRow()->valor;

    //el \ es para que visualStudio lo detecte bien
    $pdf=new \FPDF('P', 'mm', 'letter');
    $pdf->AddPage();
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetTitle("Compra");
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->Cell(195, 5, "Entrada de productos", 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->image(base_url().'Images/logo.png', 185, 10, 20, 20, 'PNG');
    $pdf->Cell(50, 5, $nombreTienda, 0, 1, 'L');
    $pdf->Cell(17, 5, utf8_decode('Dirección: '), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $direccionTienda, 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(21, 5, 'Fecha y hora: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $datosCompra['fecha_alta'], 0, 1, 'L');
    
    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(196, 5, 'Detalle de productos', 1, 1, 'C', 1);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(14, 5, 'No', 1, 0, 'L');
    $pdf->Cell(25, 5, 'Codigo', 1, 0, 'L');
    $pdf->Cell(77, 5, 'Nombre', 1, 0, 'L');
    $pdf->Cell(25, 5, 'Precio', 1, 0, 'L');
    $pdf->Cell(25, 5, 'Cantidad', 1, 0, 'L');
    $pdf->Cell(30, 5, 'Importe', 1, 1, 'L');
    
    $pdf->SetFont('Arial', '', 8);

    $contador=1;
    foreach($detalleCompra as $row){
      $pdf->Cell(14, 5, $contador, 1, 0, 'L');
      $pdf->Cell(25, 5, $row['id_producto'], 1, 0, 'L');
      $pdf->Cell(77, 5, $row['nombre'], 1, 0, 'L');
      $pdf->Cell(25, 5, $row['precio'], 1, 0, 'L');
      $pdf->Cell(25, 5, $row['cantidad'], 1, 0, 'L');
      $importe=number_format($row['precio']*$row['cantidad'], 2, '.', ',');
      $pdf->Cell(30, 5, '$: '.$importe, 1, 1, 'R');
      $contador++;
    }

    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 8);
    $total=number_format($datosCompra['total'], 2, '.', ',');
    $pdf->Cell(195, 5, 'Total: '.$total, 0, 1, 'R');

    $this->response->setHeader('Content-Type', 'application/pdf');
    $pdf->Output("compra_pdf.pdf", "I");

  }
  
}
?>