<?php
// SyntaxMiddleware.php
namespace App\Business\Middleware;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\Middleware\Received;
use BotMan\BotMan\Interfaces\Middleware\Sending;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BlueFission\Automata\Language\Grammar;
use BlueFission\Automata\Language\EntityExtractor;
use BlueFission\Automata\Language\SyntaxTreeWalker;

class SyntaxMiddleware implements Received, Sending
{
    protected $grammar;

    public function __construct(Grammar $grammar)
    {
        $this->grammar = $grammar;
    }

    public function received(IncomingMessage $message, $next, BotMan $bot)
    {
        $inputText = $message->getText();
        try {
            $tokens = $this->grammar->tokenize($inputText);
            $tree = $this->grammar->parse($tokens);

            $message->addExtras('syntax', $tree);
        } catch (\Exception $e) {
            $message->addExtras('errors', $e->getMessage());
        }

        return $next($message);
    }

    public function sending($payload, $next, BotMan $bot)
    {
        $output = $bot->getMessage()->getExtras('syntax');

        if ($output) {
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
