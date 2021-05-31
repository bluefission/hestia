<?php
use BlueFission\Services\Mapping;

// Users
Mapping::add('/api/users/$id', ['App\Business\Api\UserController', 'find'], 'api.users.find', 'get')->gateway('auth');

///
// Admin
///////

// Users
Mapping::add('/api/admin/users', ['App\Business\Api\Admin\UserController', 'index'], 'api.admin.users', 'get')->gateway('admin:auth');
Mapping::add('/api/admin/users/$id', ['App\Business\Api\Admin\UserController', 'find'], 'api.admin.users.find', 'get')->gateway('admin:auth');
Mapping::add('/api/admin/users', ['App\Business\Api\Admin\UserController', 'save'], 'api.admin.users.save', 'post')->gateway('admin:auth');
