#!/usr/bin/php
<?php
use BlueFission\Utils\Loader;
use BlueFission\BlueCore\Engine as App;

session_start();

/**
 * Load the autoloader from the settings file.
 */
require 'common/config/settings.php';

/**
 * Include the autoloader for the dependencies.
 */
require 'vendor/autoload.php';
// $autoloader = require 'common/config/settings.php';

// Loader utility for non-composer compatible scripts
$loader = Loader::instance();
$loader->addPath(getcwd());
$loader->addPath(getcwd().DIRECTORY_SEPARATOR."app");

/**
 * Create a new instance of the BlueFission App Engine.
 */
$app = App::instance();

/**
 * Bootstrap the application, set arguments, and run it.
 */
$app
    ->bootstrap()
    ->args()
    ->process()
    ->run();