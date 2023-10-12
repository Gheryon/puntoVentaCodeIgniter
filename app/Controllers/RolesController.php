<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\PermisosModel;
use App\Models\DetalleRolesPermisosModel;

class RolesController extends BaseController{
  protected $roles, $permisos, $detalleRoles;
  protected $reglas;
  
  public function __construct()
  {
    $this->roles=new RolesModel();
    $this->permisos=new PermisosModel();
    $this->detalleRoles=new DetalleRolesPermisosModel();

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
    $roles=$this->roles->where('activo', $activo)->findAll();
    $data=['titulo'=>'Roles', 'datos'=>$roles];
    echo view('header');
    echo view('roles/roles', $data);
    echo view('footer');
  }

  public function eliminados($activo=0){
    $roles=$this->roles->where('activo', $activo)->findAll();
    $data=['titulo'=>'Roles eliminados', 'datos'=>$roles];
    echo view('header');
    echo view('roles/eliminados', $data);
    echo view('footer');
  }

  public function nuevo(){
    $data=['titulo'=>'Añadir rol'];
    echo view('header');
    echo view('roles/nuevo', $data);
    echo view('footer');
  }

  public function insertar(){
    if($this->request->getMethod()=="post"&&$this->validate($this->reglas)){
      $this->roles->save(['nombre'=>$this->request->getPost('nombre')]);
      return redirect()->to(base_url().'/Roles');
    }else{
      $data=['titulo'=>'Añadir rol', 'validation'=>$this->validator];
      echo view('header');
      echo view('roles/nuevo', $data);
      echo view('footer');
    }
  }

  public function editar($id){
    $rol=$this->roles->where('id', $id)->first();
    $data=['titulo'=>'Editar Rol', 'rol'=>$rol];
    echo view('header');
    echo view('roles/editar', $data);
    echo view('footer');
  }

  public function actualizar(){
    $this->roles->update($this->request->getPost('id'), ['nombre'=>$this->request->getPost('nombre')]);
    return redirect()->to(base_url().'/Roles');
  }

  public function eliminar($id){
    $this->roles->update($id, ['activo'=>0]);
    return redirect()->to(base_url().'/Roles');
  }

  public function reinsertar($id){
    $this->roles->update($id, ['activo'=>1]);
    return redirect()->to(base_url().'/Roles');
  }

  public function detalles($idRol){
    $permisos=$this->permisos->findAll();
    $permisosAsignados=$this->detalleRoles->where('id_rol', $idRol)->findAll();
    $datos=array();
    $this->detalleRoles->verificaPermisos($idRol, 'MenuProductos');
    foreach($permisosAsignados as $permisosAsignado){
      $datos[$permisosAsignado['id_permiso']]=true;
    }
    $data=['titulo'=>'Asignar permisos', 'permisos'=>$permisos, 'id_rol'=>$idRol, 'asignado'=>$datos];
    echo view('header');
    echo view('roles/detalles', $data);
    echo view('footer');
  }

  public function guardarPermisos(){
    if($this->request->getMethod()=="post"){
      $idRol=$this->request->getPost('id_rol');
      $permisos=$this->request->getPost('permisos');

      $this->detalleRoles->where('id_rol', $idRol)->delete();
      foreach ($permisos as $permiso) {
        $this->detalleRoles->save(['id_rol'=> $idRol, 'id_permiso'=>$permiso]);
      }
      return redirect()->to(base_url()."Roles");
    }
  }

}
?>