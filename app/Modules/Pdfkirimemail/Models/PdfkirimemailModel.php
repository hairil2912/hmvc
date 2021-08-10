<?php
/**
*	App Name	: Admin Template Dashboard Codeigniter 4	
*	Developed by: Agus Prawoto Hadi
*	Website		: https://khairilanwar.web.id
*	Year		: 2021
*/

namespace App\Modules\Pdfkirimemail\Models;

class PdfkirimemailModel extends \App\Models\BaseModel
{
	private $fotoPath;
	
	public function __construct() {
		parent::__construct();
		$this->fotoPath = 'public/images/foto/';
	}
	
	public function getMahasiswa() 
	{
		$sql = 'SELECT * FROM mahasiswa';
		$result = $this->db->query($sql)->getResultArray();
		return $result;
	}
	
	public function getMahasiswaById($id) {
		$sql = 'SELECT * FROM mahasiswa WHERE id_mahasiswa = ?';
		$result = $this->db->query($sql, trim($id))->getRowArray();
		return $result;
	}
	
	public function countAllData() {
		$sql = 'SELECT COUNT(*) AS jml FROM mahasiswa';
		$result = $this->db->query($sql)->getRow();
		return $result->jml;
	}
	
	public function getListData() {
		
		$table = 'comment';

		$columns = $this->request->getPost('columns');
		$order_by = '';
		
		// Search
		$search_all = @$this->request->getPost('search')['value'];
		$where = '1 = 1';
		if ($search_all) {
			// Additional Search
			$columns[]['data'] = 'tempat_lahir';
			foreach ($columns as $val) {
				
				if (strpos($val['data'], 'ignore_search') !== false) 
					continue;
				
				if (strpos($val['data'], 'ignore') !== false)
					continue;
				
				$where_col[] = $val['data'] . ' LIKE "%' . $search_all . '%"';
			}
			 $where .= ' AND (' . join(' OR ', $where_col) . ') ';
		}
		
		// Order
		$order = $this->request->getPost('order');
		
		if (@$order[0]['column'] != '' ) {
			$order_by = ' ORDER BY ' . $columns[$order[0]['column']]['data'] . ' ' . strtoupper($order[0]['dir']);
		}

		$start = $this->request->getPost('start') ?: 0;
		$length = $this->request->getPost('length') ?: 10;
		
		// Query Data
		$sql = 'SELECT * FROM mahasiswa WHERE 
				' . $where . $order_by . ' LIMIT ' . $start . ', ' . $length;
				
		return $this->db->query($sql)->getResultArray();
	}
}
