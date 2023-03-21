<?php
namespace BlueFission\Framework\Command;

use BlueFission\Data\Storage\Storage;

class CommandProcessor
{
    protected $parser;
    protected $app;
    protected $storage;

    protected $availableCommands = [];

    protected $responseWords = [
        'yes' => ['y', 'yes', 'yeah', 'yep', 'ya', 'right', 'true', 'uh huh', 'sure', 'ok', 'okay', 'affirmative'],
        'no' => ['n', 'no', 'nope', 'nah', 'wrong', 'false', 'negative'],
    ];

    public function __construct(Storage $storage)
    {
        $this->parser = new CommandParser();
        $this->app = \App::instance();
        $this->storage = $storage;
        $this->storage->activate();
        $this->availableCommands = $this->populateAvailableCommands();
    }

    public function process($input)
    {
        $this->storage->read();
        if (!empty($this->storage->confirmCmd)) {
            if (in_array($input, $this->responseWords['yes'])) {
                $input = $this->storage->confirmCmd;
            }
            $this->storage->confirmCmd = null;
            $this->storage->write();
        }

        if ($this->storage->currentCmd) {
            $command = $command = $this->convertToCommand($this->storage->currentCmd);
            $newCommand = $this->parser->parse($input);

            if (empty($command->resources)) {
                if (empty($newCommand->resources)) {
                    $command->resources[] = $input;
                } else {
                    $command->resources = $newCommand->resources;
                }

            } else if (empty($command->verb)) {
                if (empty($newCommand->verb)) {
                    $command->verb = $input;
                } else {
                    $command->verb = $newCommand->verb;
                }
            }
        } else {
            $context = [
                'app' => 'app',
                'last_resource' => $this->storage->lastResource,
                'last_set' => $this->storage->lastSet,
            ];

            $inputWithPronouns = $this->parser->processPronouns($input, $context);

            $command = $this->parser->parse($input);
        }

        $command = $this->parser->parse($input);

        if (!$command->verb && empty($command->resources)) {
            $command = $this->parser->processQuestion($input);
        }

        if (!$command || (empty($command->verb) && empty($command->resources))) {
            return $this->suggestCommands($input, $command);
        }

        if (empty($command->verb)) {
            $this->storage->currentCmd = $command;
            $this->storage->write();
            return "What should I do with {$command->resources[0]}?";
        }

        if (empty($command->resources)) {
            $this->storage->currentCmd = $command;
            $this->storage->write();
            return "What do you want to {$command->verb}?";
        }

        // $this->storage->currentCmd = null;
        $this->storage->delete();

        return $this->executeCommand($command);
    }

    protected function executeCommand(Command $command)
    {
        $service = $command->resources[0];
        $behavior = $command->verb;
        $data = $command->args;

        $this->storage->lastResource = $command->resources[0];
        $this->storage->lastVerb = $command->verb;
        $this->storage->write();

        try {
            $result = $this->app->command($service, $behavior, $data, function ($output) {
                return $output;
            });
        } catch ( \Exception $e ) {
            $result = $e->getMessage();
        }

        return $result ?: "Command executed successfully.";
    }

    protected function convertToCommand($object)
    {
        $command = new Command();

        if (isset($object->verb)) {
            $command->verb = $object->verb;
        }

        if (isset($object->resource)) {
            $command->resource = $object->resource;
        }

        if (isset($object->args)) {
            $command->args = $object->args;
        }

        return $command;
    }

    protected function populateAvailableCommands()
    {
        $availableCommands = [];
        $abilities = $this->app->getAbilities();

        foreach ($abilities as $service => $commands) {
            foreach ($commands as $command) {
                $availableCommands[] = "$command $service";
            }
        }

        return $availableCommands;
    }

    public function suggestCommands($input, $cmd)
    {
        $bestMatch = '';
        $highestSimilarity = 0;

        foreach ($this->availableCommands as $command) {
            $similarity = 0;
            similar_text($input, $command, $similarity);

            if ($similarity > $highestSimilarity) {
                $highestSimilarity = $similarity;
                $bestMatch = $command;
            }
        }

        if ($highestSimilarity > 50) {
            $this->storage->confirmCmd = $bestMatch;
            $this->storage->write();
            $args = '';
            if ($cmd && isset($cmd->args) && is_array($cmd->args) && count($cmd->args) > 0) {
                 $args = " {$cmd->args[0]}";
            }
            return "Did you mean '{$bestMatch}{$args}'?";
        }

        return "I did not understand your command.";
    }
}
