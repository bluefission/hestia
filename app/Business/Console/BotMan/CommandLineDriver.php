<?php
namespace App\Business\Console\BotMan;

use BotMan\BotMan\Drivers\HttpDriver;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\ShouldQueue;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Users\User;

class CommandLineDriver extends HttpDriver
{
    const DRIVER_NAME = 'CommandLine';

    private $messages = [];

    public function setBotMan(BotMan $botMan)
    {
        $this->botMan = $botMan;
    }

    public function buildPayload($payload)
    {
        // if (isset($payload['message'])) {
        //     $message = new IncomingMessage($payload['message'], 'cli', 'cli');
        //     $this->setMessage($message);
        // }
    }

    public function matchesRequest()
    {
        return true;
    }

    public function getMessages()
    {
        if (empty($this->messages)) {
            $message = "Test";
            $userId = "cli";
            $sender = "cli";

            $incomingMessage = new IncomingMessage($message, $sender, $userId, $this->payload);

            $this->messages = [$incomingMessage];
        }

        $messages = [$this->messages[0]];

        return $messages;
    }

    public function getUser(IncomingMessage $matchingMessage)
    {
        return new User('cli', null, null, 'cli');
    }

    public function isConfigured()
    {
        return true;
    }

    public function reply($message, $additionalParameters = [])
    {
        if ($message instanceof Question) {
            $this->replyQuestion($message);
        } else {
            $this->replyText($message);
        }
    }

    protected function replyText($message)
    {
        printf("%c%c",0x08,0x08);
        echo PHP_EOL . $message->getText() . PHP_EOL;
        // echo '> ';
    }

    protected function replyQuestion(Question $question)
    {
        echo PHP_EOL . $question->getText() . PHP_EOL;

        $buttons = $question->getButtons();
        if (!empty($buttons)) {
            foreach ($buttons as $index => $button) {
                echo ($index + 1) . '. ' . $button['name'] . PHP_EOL;
            }
        }

        // echo '> ';
        $input = trim(fgets(STDIN));

        // Check if the input is a number and corresponds to a button
        if (is_numeric($input) && isset($buttons[$input - 1])) {
            $selectedButton = $buttons[$input - 1];
            $answer = new Answer($selectedButton['name'], $selectedButton['value']);
            // die(var_dump($answer));
        } else {
            // If the input is a number but doesn't correspond to a button, show an error message
            if (is_numeric($input)) {
                echo PHP_EOL . "Invalid selection. Please try again." . PHP_EOL;
                $this->replyQuestion($question);
                return;
            }
            // Treat the input as a free-text answer
            $answer = new Answer($input);
        }

        // $this->currentConversation->stop();
        // $this->setMessage( new IncomingMessage($answer, 'cli', 'cli') );
        $this->setMessage( new IncomingMessage($input, 'cli', 'cli') );
        $this->botMan->listen();
    }

    public function sendRequest($endpoint, array $parameters, IncomingMessage $matchingMessage)
    {
        // Implementation as provided in the previous response
    }

    public function getConversationAnswer(IncomingMessage $message)
    {
        return Answer::create($message->getText());
    }

    public function buildServicePayload($message, $matchingMessage, $additionalParameters = [])
    {
        $payload = [
            'text' => $message->getText(),
            'user_id' => $matchingMessage->getSender(),
        ];

        // You can use $additionalParameters if necessary
        // $payload = array_merge($payload, $additionalParameters);
        $this->reply($message, $additionalParameters);

        return $payload;
    }

    public function buildServicePayloadForQuestion(Question $question, $matchingMessage)
    {
        $payload = [
            'text' => $question->getText(),
            'user_id' => $matchingMessage->getSender(),
        ];

        return $payload;
    }

    public function sendPayload($payload)
    {
        // You can either call the sendRequest method directly, or implement your own logic here
        $this->sendRequest('sendMessage', $payload, new IncomingMessage('', '', ''));
    }


    public function types(IncomingMessage $matchingMessage)
    {
        // Simulate typing
        echo "..." . PHP_EOL;
        sleep(1);
    }

    /**
     * Sets the message for the CommandLineDriver.
     *
     * @param IncomingMessage $message
     * @return void
     */
    public function setMessage(IncomingMessage $message)
    {
        $this->messages = [$message];
    }
}
