<?php
use BlueFission\Services\Mapping;
use BlueFission\Net\HTTP;
use App\Business\Managers\ContentManager;

Mapping::add('/game', function() {
	return template('default', 'interactive.html', ['title'=>"Welcome", 'name'=>env('APP_NAME')]);
}, 'index', 'get');

Mapping::add('/chatwindow', function() {
	return template('chatwindow.html', ['name'=>env('APP_NAME')]);
}, 'chatwindow', 'get');

// Conversations
Mapping::add('/parse', ['App\Business\Managers\ConversationManager', 'parse'], 'parse', 'get');
Mapping::add('/history', function() {
	/*
	$thread = instance('thread');
	$prompt = null !== store('aiPrompt') ? store('aiPrompt')['prompt'] : "You are a very clever and helpful bot designed to assist people in building enterprise machine learning web applications and consulting them in best practices. Your key features are curiosity and an I've-got-this attitude!";
	$thread->setPrompt( $prompt );
	$xml = $thread->history();

	$dom = new \DOMDocument('1.0');
	$dom->preserveWhiteSpace = true;
	$dom->formatOutput = true;
	$dom->loadXML($xml);
	$xml_pretty = $dom->saveXML();

	echo $xml_pretty;
	*/
	echo "Dialogue\n\n";
	$convo = instance('convo');
	$transcript = $convo->generateRecentDialogueText(1000, 30000);
	die(var_dump($transcript));
});

Mapping::add('/command', function() {
	$processor = instance()->getDynamicInstance(BlueFission\BlueCore\Command\CommandProcessor::class);

	$result = $processor->process('help with news');

	var_dump($result);
});

Mapping::add('/clear', function() {
	$convo = instance('convo');
	$convo->clearConversation();
	
	echo "All clear!";
});

Mapping::add('/', function() {
	return template('default', 'default.html', ['title'=>"Welcome", 'name'=>env('APP_NAME'), 'csrf_token'=>HTTP::session('_token')]);
}, 'index', 'get');

Mapping::add('/test', function() {
	$object = new BlueFission\Obj();
	$value = new BlueFission\Num("25.0");
	// $value = new BlueFission\Str("test");

	$object->behavior(BlueFission\Behavioral\Behaviors\Event::CHANGE, function($event, $args) {
		echo("I changed!");
	});
	$object->num = $value;
	$object->num = 40;
	echo $object->num;
});

// Authentication
Mapping::add('/login', ['App\Business\Http\LoginController', 'login'], 'login', 'get');
Mapping::add('/register', ['App\Business\Http\LoginController', 'registration'], 'register', 'get');
Mapping::add('/forgotpassword', ['App\Business\Http\LoginController', 'forgotpassword'], 'forgotpassword', 'get');

// Admin
Mapping::add('/admin', ['App\Business\Http\AdminController', 'index'], 'admin', 'get');
Mapping::add('/admin/register', ['App\Business\Http\AdminController', 'registration'], 'admin.register', 'get');
Mapping::add('/admin/forgotpassword', ['App\Business\Http\AdminController', 'forgotpassword'], 'admin.forgotpassword', 'get');

Mapping::add('/admin/modules/dashboard', ['App\Business\Http\AdminController', 'dashboard'], 'admin.dashboard', 'get')->gateway('admin:auth');
Mapping::add('/admin/modules/users', ['App\Business\Http\AdminController', 'users'], 'admin.users', 'get')->gateway('admin:auth');
Mapping::add('/admin/modules/addons', ['App\Business\Http\AdminController', 'addons'], 'admin.addons', 'get')->gateway('admin:auth');
Mapping::add('/admin/modules/terminal', ['App\Business\Http\AdminController', 'terminal'], 'admin.terminal', 'get')->gateway('admin:auth');
Mapping::add('/admin/modules/content', ['App\Business\Http\AdminController', 'content'], 'admin.content', 'get')->gateway('admin:auth');
Mapping::add('/admin/modules/media', ['App\Business\Http\AdminController', 'media'], 'admin.media', 'get')->gateway('admin:auth');

// Dynamic Pages
ContentManager::map();