<?php
use BlueFission\BlueCore\Engine as App;
use App\Business\Console\CliManager;
use App\Business\Console\UserManager;
use App\Business\Console\DatabaseManager;

if ( !defined('STDIN') ) return;

$app = App::instance();

$app->delegate('cmd', CliManager::class);
$app->register('cmd', 'i', 'cmd');
$app->register('cmd', 't', 'chat');

$app->delegate('user', UserManager::class);
$app->register('user', 'create', 'create');
$app->register('user', 'passwd', 'changePassword');

$app->delegate('database', DatabaseManager::class);
$app->register('database', 'delta', 'runMigrations');
$app->register('database', 'revert', 'revertMigrations');
$app->register('database', 'populate', 'populate');

// $app->delegate('code', CodeManager::class );
// $app->register('code', 'generate', 'generate');
