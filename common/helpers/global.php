<?php

if(file_exists(dirname(dirname(dirname(__FILE__))).'/env.php')) {
  include_once( dirname(dirname(dirname(__FILE__))).'/env.php' );
}

if(!function_exists('env')) {
  function env($key, $default = null)
  {
      $value = getenv($key);

      if ($value === false) {
          return $default;
      }

      return $value;
  }
}


if (!function_exists( 'get_site_url' )) {
	function get_site_url( $app_id = null, $path = '', $scheme = null ) {
	    if ( empty( $app_id ) ) {
	        // $url = 'http://leads.local:8080';
	        $url = ( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] )  ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
	    } else {
	        $url = '/';
	    }
	 
	    if ( $path && is_string( $path ) ) {
	        $url .= '/' . ltrim( $path, '/' );
	    }
	 
	    return $url;
	}
}

if (!function_exists( 'dash_get_template' )) {
	function dash_get_template( $file, $values = [] ) {
		foreach ( $values as $var=>$value ) {
			$$var = $value;
		}
		/*
		$__file = func_get_arg(0);
		$trace = debug_backtrace();
		$caller_info = end($trace);
		$dir = dirname($caller_info['file']);
		// TODO: Make this more resilent against including files from and included custom directory
		// $template_dir = __DIR__. ( strpos(__DIR__, '/templates') ? "/" : "/templates/" );
		$template_dir = $dir;

		if ( strpos($dir, '/templates/custom') ) {
			$template_dir = str_replace('/templates/custom', '/templates', $template_dir);
		} elseif ( !strpos($dir, '/templates') ) {
			$template_dir .= '/templates';
		}

		$template = "";
		if(file_exists($template_dir.'/custom/'.$__file)) {
			$template = $template_dir.'/custom/'.$__file;
		} else {
			$template = $template_dir.'/'.$__file;
		}
		*/
		$template = dash_get_template_path($file);
		include_once($template);
	}
}

if (!function_exists( 'dash_get_template_path' )) {
	function dash_get_template_path( $file ) {
		$__file = func_get_arg(0);
		$trace = debug_backtrace();
		$caller_info = end($trace);
		$dir = dirname($caller_info['file']);
		// TODO: Make this more resilent against including files from and included custom directory
		// $template_dir = __DIR__. ( strpos(__DIR__, '/templates') ? "/" : "/templates/" );
		$template_dir = $dir;

		if ( strpos($dir, '/templates/custom') ) {
			$template_dir = str_replace('/templates/custom', '/templates', $template_dir);
		} elseif ( !strpos($dir, '/templates') ) {
			$template_dir .= '/templates';
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

if (!function_exists( 'dash_get_template_url' )) {
	function dash_get_template_url( $file ) {
		$__file = func_get_arg(0);
		$trace = debug_backtrace();
		$caller_info = end($trace);
		$dir = dirname($caller_info['file']);
		// TODO: Make this more resilent against including files from and included custom directory
		// $template_dir = __DIR__. ( strpos(__DIR__, '/templates') ? "/" : "/templates/" );
		$template_dir = $dir;

		if ( strpos($dir, '/templates/custom') ) {
			$template_dir = str_replace('/templates/custom', '/templates', $template_dir);
		} elseif ( !strpos($dir, '/templates') ) {
			$template_dir .= '/templates';
		}

		$template_url = str_replace(SITE_ROOT, '', $dir).'/templates';

		$url = "";
		if(file_exists($template_dir.'/custom/'.$__file)) {
			$url = $template_url.'/custom/'.$__file;
		} else {
			$url = $template_url.'/'.$__file;
		}

		return $url;
	}
}

if (!defined("SITE_ROOT") ){
	define('SITE_ROOT', dirname(dirname(dirname(__FILE__))).'/');	
}
if (!defined("DASH_ROOT") ){
	define('DASH_ROOT', dirname(dirname(dirname(__FILE__))).'/');	
}
if (!defined("ROOT_URL") ){
	define('ROOT_URL',get_site_url(null, '/' . env('DASHBOARD_DIRECTORY', 'dashboard/')));
}
if (!defined("DEBUG") ){
	define('DEBUG', false);
}

if (!function_exists( 'get_template_dir' )) {
	function get_template_dir( ) {
		$dir = str_replace(SITE_ROOT, '', __DIR__);
		$dir = ROOT_URL . $dir;
		return $dir;
	}
}