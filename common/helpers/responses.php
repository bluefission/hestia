<?php
use BlueFission\HTML\Template;
use BlueFission\Service\Response;

function template(String $file, Array $data = []) {
	$template = new Template();

	$path = dirname(getcwd()).DIRECTORY_SEPARATOR.'resource'.DIRECTORY_SEPARATOR.'markup'.DIRECTORY_SEPARATOR.$file;

	$template->load($path);

	$template->field($data);

	$output = $template->render();

	// $template->cache();

	return $output;
}

function response($data) {
	$response = new Response();

	$response->data = $data;

	return $response->message();
}