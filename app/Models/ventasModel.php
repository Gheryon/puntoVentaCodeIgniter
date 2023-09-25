<?php
namespace App\Models;
use CodeIgniter\Model;

class VentasModel extends Model{
	protected $table      = 'ventas';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['codigo', 'total', 'id_usuario', 'id_caja', 'id_cliente', 'forma_pago', 'activo'];

	// Dates
	protected $useTimestamps = true;
	protected $dateFormat    = 'datetime';
	protected $createdField  = 'fecha_alta';
	protected $updatedField  = 'fecha_edit';
	protected $deletedField  = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	/*protected $allowCallbacks = true;
	protected $beforeInsert   = [];
	protected $afterInsert    = [];
	protected $beforeUpdate   = [];
	protected $afterUpdate    = [];
	protected $beforeFind     = [];
	protected $afterFind      = [];
	protected $beforeDelete   = [];
	protected $afterDelete    = [];*/

	public function insertarVenta($id_venta, $total, $id_usuario, $id_caja, $id_cliente, $forma_pago){
		$this->insert([
      'codigo'=>$id_venta,
      'total'=>$total,
      'id_usuario'=>$id_usuario,
			'id_caja'=>$id_caja,
			'id_cliente'=>$id_cliente,
			'forma_pago'=>$forma_pago,
    ]);
		return $this->insertID();
	}

	public function obtener($activo=1){
		$this->select('ventas.*, u.usuario AS cajero, c.nombre AS cliente');
		$this->join('usuarios AS u', 'ventas.id_usuario = u.id');
		$this->join('clientes AS c', 'ventas.id_cliente = c.id');
		$this->where('ventas.activo', $activo);
		$this->orderBy('ventas.fecha_alta', 'DESC');
		$datos=$this->findAll();
		//print_r($this->getLastQuery());
		return $datos;
	}

	public function totalDia($fecha){
		$this->select("sum(total) AS total");
		$where="activo = 1 AND DATE(fecha_alta) = '$fecha'";
		return $this->where($where)->first();
	}
}
?>