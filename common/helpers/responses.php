<?php
use BlueFission\HTML\Template;
use BlueFission\Services\Response;

if (!function_exists( 'template' )) {
	function template(String $file, Array $data = []) {
		$path = dirname(getcwd()).DIRECTORY_SEPARATOR.'resource'.DIRECTORY_SEPARATOR.'markup'.DIRECTORY_SEPARATOR.$file;
		$module_path = dirname(getcwd()).DIRECTORY_SEPARATOR.'resource'.DIRECTORY_SEPARATOR.'markup'.DIRECTORY_SEPARATOR.'modules';

		$template = new Template();
		
		$template->config('module_directory', $module_path);

		$template->load($path);

		$template->field($data);

		$output = $template->render();

		// $template->cache();

		return $output;
	}
}

if (!function_exists( 'get_template' )) {
	function get_template( $file, $values = [] ) {
		foreach ( $values as $var=>$value ) {
			$$var = $value;
		}
		
		$template = get_template_path($file);
		include_once($template);
	}
}

if (!function_exists( 'get_template_path' )) {
	function get_template_path( $file ) {
		$__file = func_get_arg(0);
		$trace = debug_backtrace();
		$caller_info = end($trace);
		$dir = dirname($caller_info['file']);
		// TODO: Make this more resilent against including files from and included custom directory
		// $template_dir = __DIR__. ( strpos(__DIR__, '/markup') ? "/" : "/markup/" );
		$template_dir = $dir;

		if ( strpos($dir, '/markup/custom') ) {
			$template_dir = str_replace('/markup/custom', '/markup', $template_dir);
		} elseif ( !strpos($dir, '/markup') ) {
			// $template_dir .= '/markup';
			$template_dir = dirname(getcwd()).DIRECTORY_SEPARATOR.'resource'.DIRECTORY_SEPARATOR.'markup';
		}

		$template = "";
		if(file_exists($template_dir.'/custom/'.$__file)) {
			$template = $template_dir.'/custom/'.$__file;
		} else {
			$template = $template_dir.'/'.$__file;
		}

		return $template;
	}
}

if (!function_exists( 'template_dir' )) {
	function template_dir( ) {
		$dir = str_replace(SITE_ROOT, '', __DIR__);
		$dir = ROOT_URL . $dir;
		return $dir;
	}
}

if (!function_exists( 'get_template_url' )) {
	function get_template_url( $file ) {
		$__file = func_get_arg(0);
		$trace = debug_backtrace();
		$caller_info = end($trace);
		$dir = dirname($caller_info['file']);
		// TODO: Make this more resilent against including files from and included custom directory
		// $template_dir = __DIR__. ( strpos(__DIR__, '/markup') ? "/" : "/markup/" );
		$template_dir = $dir;

		if ( strpos($dir, '/markup/custom') ) {
			$template_dir = str_replace('/markup/custom', '/markup', $template_dir);
		} elseif ( !strpos($dir, '/markup') ) {
			// $template_dir .= '/markup';
			$template_dir = dirname(getcwd()).DIRECTORY_SEPARATOR.'resource'.DIRECTORY_SEPARATOR.'markup';
		}

		$template_url = str_replace(SITE_ROOT, '', $dir).'/markup';

		$url = "";
		if(file_exists($template_dir.'/custom/'.$__file)) {
			$url = $template_url.'/custom/'.$__file;
		} else {
			$url = $template_url.'/'.$__file;
		}

		return $url;
	}
}

function response($data) {
	$response = new Response();

	// $response->data = $data;
	$response->fill($data);
	
	header('Content-type: application/json');
	return $response->send();
}