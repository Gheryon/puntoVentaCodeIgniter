<?php
namespace App\Controllers;

use App\Models\ProductosModel as ModelsProductosModel;
use App\Models\VentasModel;

class InicioController extends BaseController{
	protected $productoModel, $ventasModel;

	public function __construct(){
		$this->productoModel=new ModelsProductosModel();
		$this->ventasModel=new VentasModel();
	}

	public function index(){
		$total=$this->productoModel->totalProductos();
		$totalVentas=$this->ventasModel->totalDia(date('Y-m-d'));
		$minimos=$this->productoModel->productosMinimo();
		$datos=['total'=>$total, 'total_ventas'=>$totalVentas, 'minimos'=>$minimos];
		echo view('header');
		echo view('inicio', $datos);
		echo view('footer');
	}
}
