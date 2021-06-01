<?php
use BlueFission\Services\Mapping;

Mapping::add('/', function() {
	return template('default.html', ['title'=>"Welcome", 'name'=>env('APP_NAME')], 'index');
}, 'get');

// Authentication
Mapping::add('/login', ['App\Business\LoginController', 'login'], 'login', 'get');
Mapping::add('/register', ['App\Business\LoginController', 'registration'], 'register', 'get');
Mapping::add('/forgotpassword', ['App\Business\LoginController', 'forgotpassword'], 'forgotpassword', 'get');

Mapping::add('/login', ['App\Business\AuthenticationController', 'login'], 'api.login', 'post');
Mapping::add('/logout', ['App\Business\AuthenticationController', 'logout'], 'api.logout', 'post')->gateway('auth');

// Admin
Mapping::add('/admin', ['App\Business\AdminController', 'index'], 'admin', 'get');
Mapping::add('/admin/register', ['App\Business\AdminController', 'registration'], 'admin.register', 'get');
Mapping::add('/admin/forgotpassword', ['App\Business\AdminController', 'forgotpassword'], 'admin.forgotpassword', 'get');

Mapping::add('/admin/modules/dashboard', ['App\Business\AdminController', 'dashboard'], 'admin.dashboard', 'get')->gateway('admin:auth');
Mapping::add('/admin/modules/users', ['App\Business\AdminController', 'users'], 'admin.users', 'get')->gateway('admin:auth');