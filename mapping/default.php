<?php
use BlueFission\Services\Mapping;
// use BlueFission\Services\Service;
// use BlueFission\Services\Response;
// use BlueFission\Behavioral\Behaviors\Behavior;
// use BlueFission\Framework\Engine as App;

// $app = App::instance();

// $app
// ->map('get', '/', function() {
// 	return template('default.html', ['title'=>"Welcome", 'name'=>env('APP_NAME')], 'index');
// })
// ->map('get', '/api/users', ['App\Business\Api\UserController', 'index'], 'api.users')

// ;

Mapping::add('/', function() {
	return template('default.html', ['title'=>"Welcome", 'name'=>env('APP_NAME')], 'index');
}, 'get');

Mapping::add('/api/users', ['App\Business\Api\UserController', 'index'], 'api.users', 'get')->gateway('auth');