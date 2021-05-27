<?php
use BlueFission\Services\Service;
use BlueFission\Services\Response;
use BlueFission\Framework\Engine as App;

$app = App::instance();

$app

// Index Page
->map('get', '/', function() {
	return template('default.html', ['title'=>"Welcome", 'name'=>env('APP_NAME')]);
})

->map('get', '/about', function() {
	return "This is the Blue Fission Framework";
})

->delegate('responder', Response::class)
	->register('responder', 'post', 'send', Service::SCOPE_LEVEL)
	->register('responder', 'get', 'send', Service::SCOPE_LEVEL)

->register('api', 'test', function( $behavior ) {
	if (\is_array($behavior)) {
		die(json_encode($behavior));
	}
	die(json_encode($behavior->_context));
})
;