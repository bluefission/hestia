<?php
use BlueFission\Framework\Engine as App;
use App\Business\Console\CliManager;
use App\Business\Console\UserManager;
use App\Business\Console\DatabaseManager;

if ( !defined('STDIN') ) return;

$app = App::instance();

$app->delegate('cmd', CliManager::class);
$app->register('cmd', 'i', 'cmd');

$app->delegate('user', UserManager::class);
$app->register('user', 'create', 'create');
$app->register('user', 'passwd', 'changePassword');

$app->delegate('database', DatabaseManager::class);
$app->register('database', 'delta', 'runMigrations');
$app->register('database', 'revert', 'revertMigrations');
