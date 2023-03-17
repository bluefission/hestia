<?php
use BlueFission\Services\Mapping;

Mapping::add('/', function() {
	return template('default.html', ['title'=>"Welcome", 'name'=>env('APP_NAME')], 'index');
}, 'get');

Mapping::add('/chatwindow', function() {
	return template('chatwindow.html', ['name'=>env('APP_NAME')], 'chatwindow');
}, 'get');

// Skills
Mapping::add('/skills', ['App\Business\Managers\SkillController', 'index'], 'skills', 'post');

// Conversations
Mapping::add('/parse', ['App\Business\Managers\ConversationManager', 'parse'], 'parse', 'post');

// Authentication
Mapping::add('/login', ['App\Business\Http\LoginController', 'login'], 'login', 'get');
Mapping::add('/register', ['App\Business\Http\LoginController', 'registration'], 'register', 'get');
Mapping::add('/forgotpassword', ['App\Business\Http\LoginController', 'forgotpassword'], 'forgotpassword', 'get');

Mapping::add('/login', ['App\Business\Http\AuthenticationController', 'login'], 'api.login', 'post');
Mapping::add('/logout', ['App\Business\Http\AuthenticationController', 'logout'], 'api.logout', 'post')->gateway('auth');

// Admin
Mapping::add('/admin', ['App\Business\Http\AdminController', 'index'], 'admin', 'get');
Mapping::add('/admin/register', ['App\Business\Http\AdminController', 'registration'], 'admin.register', 'get');
Mapping::add('/admin/forgotpassword', ['App\Business\Http\AdminController', 'forgotpassword'], 'admin.forgotpassword', 'get');

Mapping::add('/admin/modules/dashboard', ['App\Business\Http\AdminController', 'dashboard'], 'admin.dashboard', 'get')->gateway('admin:auth');
Mapping::add('/admin/modules/users', ['App\Business\Http\AdminController', 'users'], 'admin.users', 'get')->gateway('admin:auth');