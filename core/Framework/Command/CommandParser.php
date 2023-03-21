<?php
namespace BlueFission\Framework\Command;

// CommandParser.php
class CommandParser
{
    protected $verbs = [
        'do' => ['do','perform','enact'],
        'go' => ['go'],
        'make' => ['make', 'create'],
        'get' => ['get', 'retrieve'],
        'update' => ['update'],
        'delete' => ['delete', 'remove'],
        'generate' => ['generate', 'build'],
        'message' => ['message'],
        'open' => ['open'],
        'edit' => ['edit'],
        'add' => ['add','append'],
        'download' => ['download'],
        'show' => ['show', 'display'],
    ];

    protected $questionKeywords = [
        'who' => 'user',
        'what' => 'model',
        'where' => 'location',
        'when' => 'event',
        'why' => 'reason',
        'how' => 'method',
    ];

    protected $pronouns = [
        'you' => 'app',
        'it' => 'last_resource',
        'they' => 'last_set',
        'them' => 'last_set',
    ];

    protected $prepositions = [
        'to', 'in', 'from', 'at', 'on', 'for', 'with', 'about', 'as', 'by', 'of', 'over', 'through', 'under'
    ];

    protected $resourceHandlers = [];

    protected $grammar = [
        'command' => '/^(?<verb>\w+)(?:\s+(?<rest>.+))?$/',
    ];

    protected $app;

    protected $knownResources = [
        'model', 'controller', 'user', 'filemanager', 'database', 'code', 'skill'
    ];

    protected $noiseWords = [
        'a', 'an', 'the', 'and', 'to', 'in', 'on', 'with', 'by',
    ];

    public function __construct()
    {
        $this->app = \App::instance();

        // Register default resource handlers
        $this->registerResourceHandler('phone', '/^\+?\d{1,4}[\s-]?\d{1,4}(?:[\s-]?\d{1,4}){1,4}$/', null);
        $this->registerResourceHandler('email', '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i', null);
        $this->registerResourceHandler('street', '/^\d+\s[A-z]+\s[A-z]+/', null);
        $this->registerResourceHandler('web', '/^https?:\/\/[^\s]+/', null);
    }

    public function parse($input)
    {
        $command = new Command();
        $this->parseCommand($input, $command);
        return $command;
    }

    protected function parseCommand($input, Command $command)
    {
        if (preg_match($this->grammar['command'], $input, $matches)) {
            $verb = $this->findVerb($matches['verb']);
            if ($verb) {
                $command->verb = $verb;
                $this->parseResourcesAndArgs($matches['rest'] ?? '', $command);
            }
        }
    }

    public function processPronouns($input, $context)
    {
        $words = $this->splitWords($input);
        $newWords = [];

        foreach ($words as $word) {
            $lowerWord = strtolower($word);
            if (array_key_exists($lowerWord, $this->pronouns)) {
                $replacement = $context[$this->pronouns[$lowerWord]] ?? null;
                if ($replacement) {
                    $newWords[] = $replacement;
                } else {
                    $newWords[] = $word;
                }
            } else {
                $newWords[] = $word;
            }
        }

        return implode(' ', $newWords);
    }

    public function processQuestion($input)
    {
        $words = $this->splitWords($input);
        $firstWord = strtolower($words[0]);

        if (array_key_exists($firstWord, $this->questionKeywords)) {
            $service = $this->questionKeywords[$firstWord];
            $behavior = 'search';
            $args = array_slice($words, 1);

            $command = new Command();

            $command->resources[] = $service;
            $command->verb = $behavior;
            $command->args = $args;
        }

        return null;
    }

    public function registerResourceHandler($name, $pattern, callable $handler = null)
    {
        $this->resourceHandlers[$name] = [
            'pattern' => $pattern,
            'handler' => $handler,
        ];
    }

    protected function processResource($word)
    {
        foreach ($this->resourceHandlers as $name => $handlerInfo) {
            if (preg_match($handlerInfo['pattern'], $word)) {
                if (is_callable($handlerInfo['handler'])) {
                    $word = $handlerInfo['handler']($word);
                }
                break;
            }
        }

        return $word;
    }

    protected function parseResourcesAndArgs($input, Command $command)
    {
        $input = preg_replace('/\s+/', ' ', $input);
        $words = explode(' ', $input);

        $resources = [];
        $args = [];
        $currentArg = [];

        foreach ($words as $word) {
            if (in_array($word, $this->prepositions)) {
                if ($currentArg) {
                    $args[] = implode(' ', $currentArg);
                    $currentArg = [];
                }
                continue;
            }

            if ($this->isResource($word)) {
                if ($currentArg) {
                    $args[] = implode(' ', $currentArg);
                    $currentArg = [];
                }
                $resources[] = $this->normalizeResource($word);
            } else {
                $currentArg[] = $word;
            }
        }

        if ($currentArg) {
            $args[] = implode(' ', $currentArg);
        }

        $command->resources = $resources;
        $command->args = $args;
    }

    protected function processInput($input)
    {
        $commands = $this->splitCommands($input);
        $commandObjects = [];

        foreach ($commands as $command) {
            $commandObjects[] = $this->processCommand($command);
        }

        return $commandObjects;
    }

    protected function splitWords($input)
    {
        // Split the input string into words using a space as a delimiter
        $words = preg_split('/\s+/', $input);

        return $words;
    }

    protected function splitCommands($input)
    {
        $commands = preg_split('/(?<=[a-z0-9])\.(?=\s)/i', $input);
        return $commands;
    }

    protected function processCommand($command)
    {
        $command = $this->processQuotes($command);
        $words = $this->splitWords($command);
        $commandObject = new Command();

        foreach ($words as $word) {
            // process the word with existing logic
        }

        return $commandObject;
    }

    protected function processQuotes($input)
    {
        preg_match_all('/"([^"]*)"/', $input, $matches);
        $quotedStrings = $matches[1];

        foreach ($quotedStrings as $quotedString) {
            $placeholder = '__QUOTED_' . md5($quotedString) . '__';
            $this->quotedPlaceholders[$placeholder] = $quotedString;
            $input = str_replace('"' . $quotedString . '"', $placeholder, $input);
        }

        return $input;
    }

    protected function findVerb($word)
    {
        foreach ($this->verbs as $key => $synonyms) {
            if (in_array($word, $synonyms)) {
                return $key;
            }
        }
        return null;
    }

    protected function isResource($word)
    {
        $word = $this->normalizeResource($word);
        return in_array($word, $this->knownResources);
    }

    protected function normalizeResource($word)
    {
        $word = strtolower($word);

        // Remove noise words
        if (in_array($word, $this->noiseWords)) {
            return null;
        }

        // Handle pluralization
        if (substr($word, -1) === 's' && in_array(substr($word, 0, -1), $this->knownResources)) {
            $word = substr($word, 0, -1);
        }

        // Process punctuation marks
        $word = preg_replace('/[,.!?;]/', ' ', $word); // Commas, periods, exclamation marks, question marks, semicolons
        $word = preg_replace('/[\'"]/i', '', $word); // Apostrophes, quotes
        $word = preg_replace('/[\{\}\[\]\(\)]/i', '', $word); // Curly braces, brackets, parentheses
        $word = preg_replace('/\s+/', ' ', $word); // Collapse multiple spaces
        $word = trim($word); // Trim spaces at the beginning and end

        if (isset($this->quotedPlaceholders[$word])) {
            $word = $this->quotedPlaceholders[$word];
        }

        $word = $this->processResource($word);

        return $word;
    }
}