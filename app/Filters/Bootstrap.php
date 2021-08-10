<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Bootstrap implements FilterInterface
{
   public function before(RequestInterface $request, $arguments = null)
   {
	   $config = config('App');
	   
		// Custom CSRF
		if ($config->csrf['enable']) 
		{
			helper('csrf');
			
			if ($config->csrf['auto_check']) {
				$message = csrf_validation();
				if ($message) {
					echo view('app_error.php', ['content' => $message['message']]);
					exit;
				}
			}
			
			if ($config->csrf['auto_settoken']) {
				csrf_settoken();
			}
		}

		helper('module');
		$module = get_module_name();
		$nama_module = $module['url'];
		$module_url = $config->baseURL . $module['url'];
		session()->set('web', ['module_url' => $module_url, 'nama_module' => $nama_module, 'method_name' => $module['method']]);
		
   }
   
   public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
   {
       
   }  
   
}