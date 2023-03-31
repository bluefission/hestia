<?php
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\Middleware\DialogFlow\V2\DialogFlow;
use BotMan\BotMan\Drivers\DriverManager;
use App\Business\Conversations;
use App\Domain\Conversation\DialogueType;
use BlueFission\Net\HTTP;
use App\Business\Middleware\HearsIntentMiddleware;
use App\Business\Middleware\ProcessesCommandMiddleware;
use BlueFission\Data\Storage\Session;
use BlueFission\Framework\Command\CommandProcessor;
use BlueFission\Framework\Skill\Intent\Matcher;
use BlueFission\Framework\Skill\Intent\Context;
use BlueFission\Data\Storage\Storage;

$app = \App::instance();
$botman = $app->service('botman');

$hearsIntentMiddleware = $app->getDynamicInstance(HearsIntentMiddleware::class);
$botman->middleware->received($hearsIntentMiddleware);
$botman->middleware->sending($hearsIntentMiddleware);

$processesCommandMiddleware = $app->getDynamicInstance(ProcessesCommandMiddleware::class);
$botman->middleware->received($processesCommandMiddleware);
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

$botman->hears('build ml', function(BotMan $bot) {
	$bot->startConversation(new BlueFission\Framework\Conversation\ModelCriteriaConversation);
});

$botman->hears('onboard.machinelearning', function(BotMan $bot) {
	$bot->startConversation(new BlueFission\Framework\Conversation\ModelBuilderConversation);
});

// This should probably be the last `hears` call
$botman->hears('.*', function (BotMan $bot) {
    
	$interpreter = \App::instance()->service('interpreter');
	$response = $interpreter->process($bot->getMessage());

    tell($response, 'botman');
});