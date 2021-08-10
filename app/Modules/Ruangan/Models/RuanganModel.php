<?php

namespace App\Modules\Ruangan\Models;

class RuanganModel extends \App\Models\BaseModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getProduk($where)
	{
		$sql = 'SELECT * FROM ainun_data_cov' . $where;
		$result = $this->db->query($sql)->getResultArray();
		return $result;
	}

	public function updateData($data, $id)
	{
		$builder = $this->db->table('ainun_data_cov');
		$builder->update($data, ['id' => $_POST['id']]);

		return ['query' => $this->db->error(), 'id' => $id];
	}

	public function getProdukById($id)
	{
		$sql = 'SELECT * FROM ainun_data_cov WHERE id = ?';
		$result = $this->db->query($sql, $id)->getRowArray();
		return $result;
	}

	public function saveData($id)
	{

		$data_db['terpakai'] = $_POST['terpakai'];
		$data_db['kapasitas'] = $_POST['kapasitas'];


		$builder = $this->db->table('ainun_data_cov');
		if (empty($id)) {
			$builder->insert($data_db);
			$id = $this->db->insertID();
		} else {
			$builder->update($data_db, ['id' => $_POST['id']]);
		}

		return ['query' => $this->db->error(), 'id' => $id];
	}

	public function deleteProdukById($id)
	{
		$delete = $this->db->table('ainun_data_cov')->delete(['id' => $id]);
		// $delete = true;
		return $delete;
	}
}
