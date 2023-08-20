<?php
namespace App\Models;
use CodeIgniter\Model;

class ComprasModel extends Model{
	protected $table      = 'compras';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['codigo', 'total', 'id_usuario', 'activo'];

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

	public function insertarCompra($id_compra, $total, $id_usuario){
		$this->insert([
      'codigo'=>$id_compra,
      'total'=>$total,
      'id_usuario'=>$id_usuario
    ]);
		return $this->insertID();
	}
}
?>