<?php
use BlueFission\Services\Mapping;

Mapping::add('/', function() {
	return template('interactive.html', ['title'=>"Welcome", 'name'=>env('APP_NAME')], 'index');
}, 'get');

Mapping::add('/chatwindow', function() {
	return template('chatwindow.html', ['name'=>env('APP_NAME')], 'chatwindow');
}, 'get');

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
	$processor = instance()->getDynamicInstance(BlueFission\Framework\Command\CommandProcessor::class);

	$result = $processor->process('help with news');

	var_dump($result);
});

Mapping::add('/clear', function() {
	$convo = instance('convo');
	$convo->clearConversation();
	
	echo "All clear!";
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