<?php
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\Middleware\DialogFlow\V2\DialogFlow;
use BotMan\BotMan\Drivers\DriverManager;
use App\Business\Conversations;
use App\Domain\Conversation\DialogueType;
use BlueFission\Net\HTTP;

$app = \App::instance();
$botman = $app->service('bot');

// $dialogflow = DialogFlow::create('en');

// Apply global "received" middleware
// $botman->middleware->received($dialogflow);

$botman->hears('stop conversation', function(BotMan $bot) {
	$bot->reply('stopped');
})->stopsConversation();

$botman->hears('pause conversation', function(BotMan $bot) {
	$bot->reply('stopped');
})->skipsConversation();

$botman->hears('Hello', function(BotMan $bot) {
	$bot->reply("Hello, there!");
});

/*
$botman->group(['middleware' => $dialogflow], function($botman) {
	// Apply matching middleware per hears command
	$botman->hears('basic.time', function (BotMan $bot) {
	    
	    $timekeeper = new Timekeeper( $bot );

	    $reply = $timekeeper->time();

   		$convo = instance('convo');
	 	$convo->send($bot, [$reply], DialogueType::RESPONSE);

	});
	$botman->hears('basic.date', function (BotMan $bot) {
	    $message = $bot->getMessage()->getText();
	    $extras = $bot->getMessage()->getExtras();
	    
	    $apiReply = $extras['apiReply'];
	    $apiAction = $extras['apiAction'];
	    $apiIntent = $extras['apiIntent'];

		$timekeeper = new Timekeeper( $bot );
	    $reply = $timekeeper->date();

		$convo = instance('convo');
	 	$convo->send($bot, [$reply], DialogueType::RESPONSE);
	});

	$botman->fallback(function( $bot ) {
		$message = $bot->getMessage()->getText();
	    $extras = $bot->getMessage()->getExtras();
	    
	    $apiReply = $extras['apiReply'];
	    $apiAction = $extras['apiAction'];
	    $apiIntent = $extras['apiIntent'];

		$convo = instance('convo');
	 	$replies = $convo->process($message, $apiReply, $apiIntent); 
		$convo->send($bot, $replies, DialogueType::RESPONSE);
	});
});
*/