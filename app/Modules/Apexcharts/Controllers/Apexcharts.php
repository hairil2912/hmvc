<?php

/**
 * Admin Template Codeigniter 4
 * Author	: Agus Prawoto Hadi
 * Website	: https://khairilanwar.web.id
 * Year		: 2021
 */

namespace App\Modules\Apexcharts\Controllers;

use App\Modules\Apexcharts\Models\ApexchartsModel;

class Apexcharts extends \App\Controllers\BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->model = new ApexchartsModel;
		$this->addJs($this->config->baseURL . 'public/vendors/apexcharts/dist/apexcharts.min.js');
		$this->addStyle($this->config->baseURL . 'public/vendors/apexcharts/dist/apexcharts.css');
		$this->addStyle($this->config->baseURL . 'public/themes/modern/css/apexcharts-custom.css');
	}

	public function index()
	{

		$list_tahun = [2019, 2020, 2021];

		$tahun = 2021;
		if (!empty($_GET['tahun']) && in_array($_GET['tahun'], $list_tahun)) {
			$tahun = $_GET['tahun'];
		}

		$this->data['penjualan'] = $this->model->getPenjualan($tahun);
		$this->data['item_terjual'] = $this->model->getItemTerjual($tahun);
		$this->data['tahun'] = $tahun;

		if (!$this->data['penjualan'])
			$this->errorDataNotFound();

		$this->view('apexcharts.php', $this->data);
	}
}
