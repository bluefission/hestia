<?php
// IntelligenceMiddleware.php
namespace App\Business\Middleware;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\Middleware\Received;
use BotMan\BotMan\Interfaces\Middleware\Sending;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use App\Business\Services\IntelligenceService;

class IntelligenceMiddleware implements Received, Sending
{
    protected $intelligenceService;

    public function __construct(IntelligenceService $intelligenceService)
    {
        $this->intelligenceService = $intelligenceService;
    }

    public function received(IncomingMessage $message, $next, BotMan $bot)
    {
        $inputText = $message->getText();
        $intelligenceOutput = $this->intelligenceService->handleInput($inputText);
        $message->addExtras('intelligence_output', $intelligenceOutput);

        return $next($message);
    }

    public function sending($payload, $next, BotMan $bot)
    {
        $intelligenceOutput = $bot->getMessage()->getExtras('intelligence_output');

        if ($intelligenceOutput) {
            // Perform any necessary actions based on the intelligence output
            // before sending the message
        }

        return $next($payload);
    }

    public function matching(IncomingMessage $message, $pattern, $regexMatched)
    {
        return $regexMatched;
    }
}
