<?php

/**
 *	App Name	: Admin Template Dashboard Codeigniter 4	
 *	Developed by: Agus Prawoto Hadi
 *	Website		: https://khairilanwar.web.id
 *	Year		: 2021
 */

namespace App\Modules\Covid\Models;

class CovidModel extends \App\Models\BaseModel
{
	private $fotoPath;

	public function __construct()
	{
		parent::__construct();
		$this->fotoPath = 'public/images/foto/';
	}

	public function deleteData()
	{

		$result = $this->db->table('ainun_data_cov')->delete(['id' => $_POST['id']]);
		return $result;
	}

	public function getMahasiswa($where = null)
	{
		$sql = "SELECT * FROM ainun_data_cov  ORDER BY created_at DESC";
		$result = $this->db->query($sql)->getResultArray();
		return $result;
	}

	public function getMahasiswaById($id)
	{
		$sql = 'SELECT * FROM mahasiswa WHERE id_mahasiswa = ?';
		$result = $this->db->query($sql, trim($id))->getRowArray();
		return $result;
	}

	public function saveData()
	{

		foreach ($_POST['tanggal'] as $key => $val) {
			$data_db[] = [
				'tanggal' => $val,
				'ruangan' => $_POST['ruangan'][$key],
				'terkonfirmasi' => $_POST['terkonfirmasi'][$key],
				'suspek' => $_POST['suspek'][$key],
				'created_at' => date("Y-m-d H:i:s"),
			];
		}

		$result = false;
		// echo '<pre>'; print_r($data_db); die;
		// EDIT
		if (!empty($_POST['id'])) {
			$result = $this->db->table('ainun_cov')->update($data_db[0], 'id = ' . $_POST['id']);
		} else {
			$result = $this->db->table('ainun_cov')->insertBatch($data_db);
		}

		return $result;
	}
}
