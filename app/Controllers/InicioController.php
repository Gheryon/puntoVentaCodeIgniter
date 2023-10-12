<?php
namespace App\Controllers;

use App\Models\ProductosModel as ModelsProductosModel;
use App\Models\VentasModel;

class InicioController extends BaseController{
	protected $productoModel, $ventasModel, $session;

	public function __construct(){
		$this->productoModel=new ModelsProductosModel();
		$this->ventasModel=new VentasModel();
		$this->session=session();
	}

	public function index(){
		if(!isset($this->session->id_usuario)){
			return redirect()->to(base_url());
		}
		$total=$this->productoModel->totalProductos();
		$totalVentas=$this->ventasModel->totalDia(date('Y-m-d'));
		$minimos=$this->productoModel->productosMinimo();
		$datos=['total'=>$total, 'total_ventas'=>$totalVentas, 'minimos'=>$minimos];
		echo view('header');
		echo view('inicio', $datos);
		echo view('footer');
	}
}
