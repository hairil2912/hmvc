<?php

namespace App\Modules\Ruangan\Controllers;

use App\Modules\Ruangan\Models\RuanganModel;

class Ruangan extends \App\Controllers\BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->model = new RuanganModel;
	}

	public function index()
	{
		$data = $this->data;

		if ($this->request->getPost('delete')) {
			$this->cekHakAkses('delete_data');

			$delete = $this->model->deleteProdukById($_POST['id']);
			if ($delete) {
				$data['message'] = ['status' => 'ok', 'message' => 'Data produk berhasil dihapus'];
			} else {
				$data['message'] = ['status' => 'warning', 'message' => 'Tidak ada data yang dihapus'];
			}
		}

		$data['result'] = $this->model->getProduk($this->whereOwn());

		if (!$data['result'])
			$this->errorDataNotFound();

		$this->view('produk-result.php', $data);
	}

	public function edit()
	{
		//$this->cekHakAkses('_data');

		if (empty($_GET['id']))
			$this->errorDataNotFound();


		if (!empty($_POST['submit'])) {
			$result = $this->saveData();
			return	$this->data['message'] = $result['message'];
		}
	}

	public function add()
	{

		$this->cekHakAkses('create_data');

		$this->data['title'] = 'Tambah Data Produk';

		if (!empty($_POST['submit'])) {
			$result = $this->saveData();
			$this->data['message'] = $result['message'];
			$this->data['id_produk'] = $result['id_produk'];
		}

		$this->view('produk-form.php', $this->data);
	}

	public function update()
	{

		$id = $_POST['id'];
		$data = array(
			'terpakai' => $_POST['terpakai'],
			'kapasitas' => $_POST['kapasitas'],
			'updated_at' => $_POST['updated_at'],
		);
		$this->model->updateData($data, $id);
		$result['message'] = 'Data berhasil disimpan';
		return redirect()->to(base_url('/index.php/ruangan'));
	}

	private function saveData()
	{


		$result = [];
		$id = '';
		if (!empty($_POST['submit'])) {
			$error = $this->validateForm();
			if ($error) {
				$result['status'] = 'error';
				$result['message'] = $error;
			} else {

				$save = $this->model->saveData(@$_POST['id']);

				if ($save['query']['message'] == '') {
					$result['status'] = 'ok';
					$result['message'] = 'Data berhasil disimpan';
				} else {
					$result['status'] = 'error';
					$result['message'] = 'Data gagal disimpan';
				}

				$id = $save['id'];
			}
		}
		return ['message' => $result, 'id' => $id];
	}

	private function validateForm()
	{
		$validation =  \Config\Services::validation();
		$validation->setRule('nama_produk', 'Nama Produk', 'trim|required');
		$validation->setRule('deskripsi_produk', 'Deskripsi Produk', 'trim|required');
		$validation->withRequest($this->request)->run();
		return $validation->getErrors();
	}
}
