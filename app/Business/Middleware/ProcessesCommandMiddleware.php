<?php
// ProcessesCommandMiddleware.php
namespace App\Business\Middleware;

use BotMan\BotMan\BotMan;
use BlueFission\Data\Storage\Session;
use App\Business\Managers\CommandManager;
use BlueFission\BlueCore\Command\CommandProcessor;
use BotMan\BotMan\Interfaces\Middleware\Received;
use BotMan\BotMan\Interfaces\Middleware\Sending;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class ProcessesCommandMiddleware implements Received, Sending
{
    protected $commandManager;
    protected $commandProcessor;

    public function __construct(CommandManager $commandManager, CommandProcessor $commandProcessor)
    {
        $this->commandManager = $commandManager;
        $this->commandProcessor = $commandProcessor;
    }

    public function received(IncomingMessage $message, $next, BotMan $bot)
    {
        $results = $this->commandManager->parse($message->getText());
        $message->addExtras('command', $results);

        return $next($message);
    }

    public function sending($payload, $next, BotMan $bot)
    {
        $walkerResults = $bot->getMessage()->getExtras('command');

        if ($walkerResults && $walkerResults['subject'] === 'app') {
            // ... (the existing code)
            return $next($payload)->then(function ($response) use ($bot, $walkerResults) {
                
                // You can perform any action you want here using $bot and $walkerResults

                // For example, log the message sent and received by the user
                $this->logMessage($bot, $walkerResults);
            });
        }

        return $next($payload);
    }

    protected function logMessage(BotMan $bot, $walkerResults)
    {
        // Implement your custom logic to log the message or perform other actions
        // You can use the $bot and $walkerResults variables to access relevant information
        $command = $this->commandProcessor->process($walkerResults);
        
        if ($command->confirmationRequired()) {
            $question = Question::create("Do you want to proceed with this command: {$command->getDescription()}?")
                ->addButtons([
                    Button::create('Yes')->value('yes'),
                    Button::create('No')->value('no'),
                ]);

            $bot->ask($question, function (IncomingMessage $response) use ($bot, $command) {
                if ($response->getValue() === 'yes') {
                    // // Execute the command
                    // $this->commandProcessor->executeCommand($command);
                    // // Forward the conversation to a representative
                    // $contactManager = new ContactManager();
                    // $contactManager->forwardConversationToRepresentative($bot, $response);
                    $this->command($command);
                }
            });
        } else {
            // Automatically execute the command
            $this->command($command);
        }
    }

    public function matching(IncomingMessage $message, $pattern, $regexMatched)
    {
        return $regexMatched;
    }
}
