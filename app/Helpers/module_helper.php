<?php
function get_module_name() 
{
	$uri = service('uri');
	$uri_segments = $uri->getSegments();
	
	$module = find_module_name( $uri_segments );
	
	// echo '<pre>'; print_r($module); 
	$method = count($uri_segments) > count($module['name']) ? $uri_segments[ count($module['name']) ] : 'index';
	
	return [
		'segments' => join('/' , $uri_segments)
		, 'url' => join('/' , $module['url'])
		, 'class' => ucfirst( end($module['name']) )
		, 'name' => join('\\', $module['name']) 
		, 'method' => $method
	];
}

function find_module_name($uri_segments) 
{
	$module = [];
	foreach ( $uri_segments as $key => $item )
	{
		$name = ucfirst( strtolower(str_replace('-','_',$item)) );
		$name_segments[] = $name;
		$module_name = join('\\', $name_segments);
		
		$path = APPPATH . 'Modules\\' . $module_name;
		// echo$path .'<br/>';
		if ( is_dir($path) ) {
			$module['name'][] = $name;
			$module['url'][] = $item;
		}
	}

	if (!$module) {
		if ($uri_segments) {
			
			$module['name'][] = ucfirst($uri_segments[0]);
			$module['url'][] = $uri_segments[0];
		} else {
			
			$router = service('router');
			$controller  = $router->controllerName();
			$exp = explode('\\', $controller);
			$module['name'][] = ucfirst( $exp[count($exp) - 1] );
			$module['url'][] = strtolower($exp[count($exp) - 1]);
		}
	}

	return $module;
}
?>