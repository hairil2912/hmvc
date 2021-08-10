<?php

namespace App\Modules\Web\Controllers;

class Web extends \App\Controllers\BaseController
{
	public function index()
	{
		echo view('App\Modules\Web\Views\welcome.php');
	}
}
