<?php

/**
 *	App Name	: Admin Template Dashboard Codeigniter 4	
 *	Author		: Agus Prawoto Hadi
 *	Website		: https://khairilanwar.web.id
 *	Year		: 2021
 */

namespace App\Modules\Covid\Controllers;

use App\Modules\Covid\Models\CovidModel;

class Covid extends \App\Controllers\BaseController
{
	public function __construct()
	{

		parent::__construct();

		$this->model = new CovidModel;
		$this->data['site_title'] = 'Data Tables';

		$this->addJs($this->config->baseURL . 'public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js');
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/date-picker.js');
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/image-upload.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/datatables.min.js');

		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/dataTables.buttons.min.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/JSZip/jszip.min.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/pdfmake/pdfmake.min.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/pdfmake/vfs_fonts.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/buttons.html5.min.js');
		$this->addJs($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/js/buttons.print.min.js');
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/penghadap.js');


		$this->addStyle($this->config->baseURL . 'public/vendors/datatables/datatables.min.css');
		$this->addJs($this->config->baseURL . 'public/themes/modern/js/data-tables.js');
		$this->addStyle($this->config->baseURL . 'public/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.css');
		$this->addStyle($this->config->baseURL . 'public/vendors/datatables/extensions/Buttons/css/buttons.dataTables.min.css');
	}

	public function index()
	{
		$this->cekHakAkses('read_data');

		$data = $this->data;
		if (!empty($_POST['delete'])) {
			$this->cekHakAkses('delete_data', 'mahasiswa');

			$result = $this->model->deleteData();

			// $result = true;
			if ($result) {
				$data['msg'] = ['status' => 'ok', 'message' => 'Data berhasil dihapus'];
			} else {
				$data['msg'] = ['status' => 'error', 'message' => 'Data gagal dihapus'];
			}
		}

		$data['result'] = $this->model->getMahasiswa($this->whereOwn());
		$this->view('data-tables-result.php', $data);
	}

	public function add()
	{
		$this->cekHakAkses('create_data');

		$data = $this->data;
		$data['title'] = 'Tambah Data Penghadap';
		if (empty($_GET['id'])) {
			$breadcrumb['Add'] = '';
		}

		// Submit
		$data['msg'] = [];
		if (isset($_POST['submit'])) {
			//$form_errors = $this->validateForm();
			$form_errors = false;

			if ($form_errors) {
				$data['msg']['status'] = 'error';
				$data['msg']['content'] = $form_errors;
			} else {

				$result = $this->model->saveData();

				if ($result) {
					$data['msg']['status'] = 'ok';
					$data['msg']['content'] = 'Data berhasil disimpan';
				} else {
					$data['msg']['status'] = 'error';
					$data['msg']['content'] = 'Data gagal disimpan';
				}

				$data['title'] = 'Edit Data Penghadap';
			}
		}


		$this->view('image-upload-form.php', $data);
	}

	public function edit()
	{
		$this->cekHakAkses('update_data', 'mahasiswa');

		$this->data['title'] = 'Edit ' . $this->currentModule['judul_module'];;
		$data = $this->data;

		if (empty($_GET['id'])) {
			$this->errorDataNotFound();
		}

		// Submit
		$data['msg'] = [];
		if (isset($_POST['submit'])) {
			// $form_errors = validate_form();
			$form_errors = false;

			if ($form_errors) {
				$data['msg']['status'] = 'error';
				$data['msg']['content'] = $form_errors;
			} else {

				// $query = false;
				$message = $this->model->saveData();
				$data = array_merge($data, $message);
			}
		}

		$data['breadcrumb']['Edit'] = '';

		$data_mahasiswa = $this->model->getMahasiswaById($_GET['id']);
		if (empty($data_mahasiswa)) {
			$this->errorDataNotFound();
		}
		$data = array_merge($data, $data_mahasiswa);

		$this->view('image-upload-form.php', $data);
	}
}
