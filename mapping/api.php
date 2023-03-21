<?php
use BlueFission\Services\Mapping;

// Users
Mapping::add('/api/users/$user_id', ['App\Business\Api\UserController', 'find'], 'api.users.find', 'get')->gateway('auth');

Mapping::add('/api/chat', ['App\Business\Http\Api\ChatController', 'send'], 'api.chat', 'post')->gateway('nocsrf');


Mapping::add('/login', ['App\Business\Http\Api\AuthenticationController', 'login'], 'api.login', 'post');
Mapping::add('/logout', ['App\Business\Http\Api\AuthenticationController', 'logout'], 'api.logout', 'post')->gateway('auth');

///
// Admin
///////

// Users
Mapping::add('/api/admin/users', ['App\Business\Http\Api\Admin\UserController', 'index'], 'api.admin.users', 'get')->gateway('admin:auth');
Mapping::add('/api/admin/users/$user_id', ['App\Business\Http\Api\Admin\UserController', 'find'], 'api.admin.users.find', 'get')->gateway('admin:auth');
Mapping::add('/api/admin/users', ['App\Business\Http\Api\Admin\UserController', 'save'], 'api.admin.users.save', 'post')->gateway('admin:auth');

Mapping::add('/api/admin/credential_statuses', ['App\Business\Http\Api\Admin\UserController', 'credentialStatuses'], 'api.admin.users.credential_statuses', 'get')->gateway('admin:auth');
Mapping::add('/api/admin/users/$user_id/credentials', ['App\Business\Http\Api\Admin\UserController', 'updateCredentials'], 'api.admin.users.credentials', 'post')->gateway('admin:auth');
