<?php

if (!function_exists( 'get_site_url' )) {
	function get_site_url( $app_id = null, $path = '', $scheme = null ) {
	    if ( empty( $app_id ) && isset($_SERVER['HTTPS']) && isset($_SERVER['HTTP_HOST']) ) {
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

if (!defined("ROOT_URL") ){
	define('ROOT_URL', get_site_url(null, '/' . env('DASHBOARD_DIRECTORY', 'dashboard/')));
}