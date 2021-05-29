<?php
use BlueFission\Services\Mapping;

Mapping::add('/api/users', ['App\Business\Api\UserController', 'index'], 'api.users', 'get')->gateway('auth');