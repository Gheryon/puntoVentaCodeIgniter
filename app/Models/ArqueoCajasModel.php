<?php
namespace App\Models;
use CodeIgniter\Model;

class ArqueoCajasModel extends Model{
	protected $table      = 'arqueo_caja';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['id_caja', 'id_usuario', 'fecha_inicio', 'fecha_fin', 'monto_inicial', 'monto_final', 'total_ventas', 'estatus'];

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

	public function getDatos($idCaja){
		$this->select('arqueo_caja.*, cajas.nombre');
		$this->join('cajas', 'arqueo_caja.id_caja=cajas.id');
		$this->where('arqueo_caja.id_caja', $idCaja);
		$this->orderBy('arqueo_caja.id', 'DESC');
		$datos=$this->findAll();

		return $datos;
	}
}
?>