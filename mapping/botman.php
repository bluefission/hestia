<?php
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\Middleware\DialogFlow\V2\DialogFlow;
use BotMan\BotMan\Drivers\DriverManager;
use App\Business\Conversations;
use App\Domain\Conversation\DialogueType;
use BlueFission\Net\HTTP;
use App\Business\Middleware\HearsIntentMiddleware;
use BlueFission\Data\Storage\Session;
use BlueFission\Framework\Command\CommandProcessor;

$app = \App::instance();
$botman = $app->service('botman');

$hearsIntentMiddleware = $app->getDynamicInstance(HearsIntentMiddleware::class);
$botman->middleware->received($hearsIntentMiddleware);
$botman->middleware->sending($hearsIntentMiddleware);
// $botman->middleware->received(function (IncomingMessage $message, $next, BotMan $bot) use ($hearsIntentMiddleware) {
//     return $hearsIntentMiddleware->received($message, $next, $bot);
// });

// $botman->middleware->sending(function (OutgoingMessage $message, $next, BotMan $bot) use ($hearsIntentMiddleware) {
//     return $hearsIntentMiddleware->sending($message, $next, $bot);
// });

// $dialogflow = DialogFlow::create('en');

// Apply global "received" middleware
// $botman->middleware->received($dialogflow);

$botman->hears('stop conversation', function(BotMan $bot) {
	$bot->reply('stopped');
})->stopsConversation();

$botman->hears('pause conversation', function(BotMan $bot) {
	$bot->reply('stopped');
})->skipsConversation();

$botman->hears('build ml', function(BotMan $bot) {
	$bot->startConversation(new BlueFission\Framework\Conversation\ModelCriteriaConversation);
});

$botman->hears('onboard.machinelearning', function(BotMan $bot) {
	$bot->startConversation(new BlueFission\Framework\Conversation\ModelBuilderConversation);
});

$botman->hears('{input}', function(BotMan $bot, $input) {
	// $input = "create a model named products and generate a FileManager controller";
	$sessionStorage = new Session(['location'=>'cache','name'=>'system']);
	$commandProcessor = new CommandProcessor($sessionStorage);

	$response = $commandProcessor->process($input);
	$bot->reply($response);
});

// $botman->fallback(function($bot) {
//     $bot->reply('Sorry, I did not understand these commands.');
// });

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