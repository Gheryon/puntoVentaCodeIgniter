<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\CajasModel;
use App\Models\ArqueoCajasModel;
use App\Models\VentasModel;

class CajasController extends BaseController{
  protected $cajas, $arqueoCaja, $ventasModel;
  protected $reglas;
  
  public function __construct()
  {
    $this->cajas=new CajasModel();
    $this->arqueoCaja=new ArqueoCajasModel();
    $this->ventasModel=new VentasModel();

    helper(['form']);
    $this->reglas=[
      'nombre'=> [
        'rules'=>'required', 
        'errors'=>[
          'required'=>'El campo {field} es obligatorio.'
          ]
        ]
      ];
  }

  public function index($activo=1){
    $cajas=$this->cajas->where('activo', $activo)->findAll();
    $data=['titulo'=>'Cajas', 'datos'=>$cajas];
    echo view('header');
    echo view('cajas/cajas', $data);
    echo view('footer');
  }

  public function eliminados($activo=0){
    $cajas=$this->cajas->where('activo', $activo)->findAll();
    $data=['titulo'=>'Cajas eliminados', 'datos'=>$cajas];
    echo view('header');
    echo view('cajas/eliminados', $data);
    echo view('footer');
  }

  public function nuevo(){
    $data=['titulo'=>'Añadir caja'];
    echo view('header');
    echo view('cajas/nuevo', $data);
    echo view('footer');
  }

  public function insertar(){
    if($this->request->getMethod()=="post"&&$this->validate($this->reglas)){
      $this->cajas->save(['nombre'=>$this->request->getPost('nombre')]);
      return redirect()->to(base_url().'/Cajas');
    }else{
      $data=['titulo'=>'Añadir caja', 'validation'=>$this->validator];
      echo view('header');
      echo view('cajas/nuevo', $data);
      echo view('footer');
    }
  }

  public function editar($id){
    $rol=$this->cajas->where('id', $id)->first();
    $data=['titulo'=>'Editar Rol', 'rol'=>$rol];
    echo view('header');
    echo view('cajas/editar', $data);
    echo view('footer');
  }

  public function actualizar(){
    $this->cajas->update($this->request->getPost('id'), ['nombre'=>$this->request->getPost('nombre')]);
    return redirect()->to(base_url().'/Cajas');
  }

  public function eliminar($id){
    $this->cajas->update($id, ['activo'=>0]);
    return redirect()->to(base_url().'/Cajas');
  }

  public function reinsertar($id){
    $this->cajas->update($id, ['activo'=>1]);
    return redirect()->to(base_url().'/Cajas');
  }

  public function arqueo($idCaja){
    $arqueos=$this->arqueoCaja->getDatos($idCaja);
    $data=['titulo'=>'Cierres de caja', 'datos'=>$arqueos];
    echo view('header');
    echo view('cajas/arqueos', $data);
    echo view('footer');
  }

  public function nuevo_arqueo(){
    $session=session();

    $existe=0;
    $existe=$this->arqueoCaja->where(['id_caja'=>$session->id_caja, 'estatus'=> 1])->countAllResults();

    if($existe>0){
      echo 'La caja ya está abierta';
      exit;
      //return redirect()->to(base_url().'Cajas');
    }else{

    }

    if($this->request->getMethod()=="post"){//el usuario envía datos
      $fecha=date('Y-m-d h:i:s');      

      $this->arqueoCaja->save(['id_caja'=>$session->id_caja, 'id_usuario'=> $session->id_usuario, 'fecha_inicio'=>$fecha, 'monto_inicial'=>$this->request->getPost('monto_inicial'), 'estatus'=>1]);

      return redirect()->to(base_url().'Cajas');

    }else{//el usuario solicita datos
      $caja= $this->cajas->where('id', $session->id_caja)->first();
      $data=['titulo'=>'Apertura de caja', 'caja'=>$caja, 'session'=>$session];
      echo view('header');
      echo view('cajas/nuevo_arqueo', $data);
      echo view('footer');
    }
  }

  public function cierre(){
    $session=session();

    $existe=0;
    $existe=$this->arqueoCaja->where(['id_caja'=>$session->id_caja, 'estatus'=> 1])->countAllResults();

    if($this->request->getMethod()=="post"){//el usuario envía datos
      $fecha=date('Y-m-d h:i:s');      

      $this->arqueoCaja->update($this->request->getPost('id_arqueo'), ['fecha_fin'=>$fecha, 'monto_final'=>$this->request->getPost('monto_final'), 'total_ventas'=>$this->request->getPost('total_ventas'), 'estatus'=>0]);

      return redirect()->to(base_url().'Cajas');

    }else{//el usuario solicita datos
      $montoTotal=$this->ventasModel->totalDia(date('Y-m-d'));
      $arqueo=$this->arqueoCaja->where(['id_caja'=>$session->id_caja, 'estatus'=> 1])->first();
      $caja= $this->cajas->where('id', $session->id_caja)->first();
      $data=['titulo'=>'Cierre de caja', 'caja'=>$caja, 'session'=>$session, 'arqueo'=>$arqueo, 'monto'=>$montoTotal];

      echo view('header');
      echo view('cajas/cerrar', $data);
      echo view('footer');
    }
  }

}
?>