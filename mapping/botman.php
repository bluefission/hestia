<?php
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\Middleware\DialogFlow\V2\DialogFlow;
use BotMan\BotMan\Drivers\DriverManager;
use App\Business\Conversations;
use App\Domain\Conversation\DialogueType;
use App\Business\Middleware\HearsIntentMiddleware;
use App\Business\Middleware\ProcessesCommandMiddleware;
use App\Business\Middleware\IntelligenceMiddleware;
use BlueFission\Data\Storage\Session;
use BlueFission\Automata\Intent\Matcher;
use BlueFission\Automata\Context;
use BlueFission\Data\Storage\Storage;

$app = instance();
$botman = instance('botman');

$hearsIntentMiddleware = $app->getDynamicInstance(HearsIntentMiddleware::class);
$botman->middleware->received($hearsIntentMiddleware);
$botman->middleware->sending($hearsIntentMiddleware);

$intelligenceMiddleware = $app->getDynamicInstance(IntelligenceMiddleware::class);
$botman->middleware->received($intelligenceMiddleware);

// $processesCommandMiddleware = $app->getDynamicInstance(ProcessesCommandMiddleware::class);
// $botman->middleware->received($processesCommandMiddleware);
// $botman->middleware->sending($processesCommandMiddleware);

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

$botman->hears('clear conversation', function(BotMan $bot) {
	store('conversation', "");
	$bot->reply("Conversation cache is cleared");
});

// $botman->hears('set {key} to {value}', function(BotMan $bot) {
// 	store($key, $value);
// 	$bot->reply("Value set");
// });

// $botman->hears('get {key}', function(BotMan $bot) {
// 	$value = store($key);
// 	$bot->reply("{$key} is $value");
// });


// This should probably be the last `hears` call
$botman->hears('.*', function (BotMan $bot) {
	$interpreter = instance('interpreter');
	$responses = $interpreter->process($bot->getMessage());

    do {
		foreach ($responses as $response) {
			if ($response) {
	    		tell($response, 'botman');
			}
	    }
	    $responses = [];

	    if ( $interpreter->continue() ) {
			$responses = $interpreter->process();
	    }
	} while ( $interpreter->continue() );

	foreach ($responses as $response) {
		if ($response) {
    		tell($response, 'botman');
		}
    }
});