<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\ComprasTemporalModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionModel;

class VentasController extends BaseController{
  protected $ventas, $compras_temporal, $detalle_venta, $productos, $configuracion;

  public function __construct()
  {
    $this->ventas=new VentasModel();
    $this->detalle_venta=new DetalleVentaModel();
    $this->configuracion=new ConfiguracionModel();
    helper(['form']);
  }

  public function index($activo=1){
    $ventas=$this->ventas->where('activo', $activo)->findAll();
    $data=['titulo'=>'Historial de ventas', 'ventas'=>$ventas];
    echo view('header');
    echo view('ventas/ventas', $data);
    echo view('footer');
  }

  public function venta(){
    echo view('header');
    echo view('ventas/caja');
    echo view('footer');
  }

  public function guardar_venta(){
    $id_venta=$this->request->getPost('id_venta');
    $forma_pago=$this->request->getPost('forma_pago');
    $id_cliente=$this->request->getPost('id_cliente');
    $total=preg_replace('/[\$,]/', '', $this->request->getPost('total'));
    $session=session();
    $resultado_id=$this->ventas->insertarVenta($id_venta, $total, $session->id_usuario, $session->id_caja, $id_cliente, $forma_pago);
    
    if($resultado_id){
      $this->compras_temporal=new ComprasTemporalModel();
      $resultadoCompra=$this->compras_temporal->porCompra($id_venta);
      foreach($resultadoCompra as $row){
        $this->detalle_venta->save([
          'id_venta'=>$resultado_id,
          'id_producto'=>$row['id_producto'],
          'nombre'=>$row['nombre'],
          'cantidad'=>$row['cantidad'],
          'precio'=>$row['precio']
        ]);
        $this->productos=new ProductosModel();
        $this->productos->actualizarStock($row['id_producto'], $row['cantidad'], '-');
      }
      $this->compras_temporal->eliminarCompra($id_venta);
    }
    return redirect()->to(base_url()."Ventas/ver_ticket/".$resultado_id);
  }
  
  function muestraTicket($id_venta){
    $data['id_venta']=$id_venta;
    echo view('header');
    echo view('Ventas/ver_ticket', $data);
    echo view('footer');
  }

  function generarTicket($id_venta){
    $datosVenta=$this->ventas->where('id', $id_venta)->first();
    $this->detalle_venta->select('*');
    $this->detalle_venta->where('id_venta', $id_venta);
    $detalleVenta=$this->detalle_venta->findAll();
    $this->configuracion->select('valor');
    $this->configuracion->where('nombre', 'tienda_nombre');
    $nombreTienda=$this->configuracion->get()->getRow()->valor;
    $this->configuracion->select('valor');
    $this->configuracion->where('nombre', 'tienda_direccion');
    $direccionTienda=$this->configuracion->get()->getRow()->valor;
    $this->configuracion->select('valor');
    $this->configuracion->where('nombre', 'ticket_leyenda');
    $leyendaTicket=$this->configuracion->get()->getRow()->valor;

    //el \ es para que visualStudio lo detecte bien
    $pdf=new \FPDF('P', 'mm', array(80, 200));
    $pdf->AddPage();
    $pdf->SetMargins(5, 5, 5);
    $pdf->SetTitle("Venta");
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->Cell(70, 5, $nombreTienda, 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->image(base_url().'Images/logo.png', 5, 4, 20, 20, 'PNG');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $direccionTienda, 0, 1, 'C');

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(21, 5, 'Fecha y hora: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $datosVenta['fecha_alta'], 0, 1, 'L');
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(11, 5, 'Ticket: ', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 5, $datosVenta['codigo'], 0, 1, 'L');

    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(7, 5, 'Cant', 0, 0, 'L');
    $pdf->Cell(35, 5, 'Nombre', 0, 0, 'L');
    $pdf->Cell(15, 5, 'Precio', 0, 0, 'L');
    $pdf->Cell(15, 5, 'Importe', 0, 1, 'L');
    
    $pdf->SetFont('Arial', '', 7);

    $contador=1;
    foreach($detalleVenta as $row){
      $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
      $pdf->Cell(35, 5, $row['nombre'], 0, 0, 'L');
      $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
      $importe=number_format($row['precio']*$row['cantidad'], 2, '.', ',');
      $pdf->Cell(15, 5, '$: '.$importe, 0, 1, 'L');
      $contador++;
    }

    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 8);
    $total=number_format($datosVenta['total'], 2, '.', ',');
    $pdf->Cell(70, 5, 'Total: '.$total, 0, 1, 'R');

    $pdf->Ln();
    $pdf->MultiCell(70, 4, $leyendaTicket, 0, 'C', 0);

    $this->response->setHeader('Content-Type', 'application/pdf');
    $pdf->Output("ticket.pdf", "I");

  }
}
?>