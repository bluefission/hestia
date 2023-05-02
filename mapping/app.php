<?php
use BlueFission\Framework\Engine as App;
use App\Business\Commands\EncyclopediaCommand;
use App\Business\Commands\CalculatorCommand;
use App\Business\Commands\HowToCommand;
use App\Business\Commands\CommandHelper;
use App\Business\Commands\FeatureCommand;
use App\Business\Commands\SearchCommand;
use App\Business\Commands\WebBrowserCommand;
use App\Business\Commands\WeatherCommand;
use App\Business\Commands\NewsCommand;
use App\Business\Commands\SystemResourceCommand;
use App\Business\Commands\VariableCommand;
use App\Business\Commands\StackCommand;
use App\Business\Commands\QueueCommand;
use App\Business\Commands\FileCommand;
use App\Business\Commands\NoteCommand;
use App\Business\Commands\TodoCommand;
use App\Business\Commands\StepCommand;
use App\Business\Commands\ScheduleCommand;
use App\Business\Commands\ResourceCommand;
use App\Business\Commands\MessageCommand;
use App\Business\Commands\EntityCommand;
use App\Business\Commands\AICommand;
use App\Business\Commands\APICommand;
use App\Business\Commands\ActionCommand;
use App\Business\Commands\UserCommand;

$app = App::instance();

$app->register( 'skill', 'do', 'runSkill' );
$app->register( 'skill', 'list', 'listSkills' );

$app->delegate( 'feature', FeatureCommand::class );
$app->register( 'feature', 'list', 'handle' );
$app->register( 'feature', 'show', 'handle' );
$app->register( 'feature', 'more', 'handle' );
$app->register( 'feature', 'help', 'handle' );

$app->delegate( 'action', ActionCommand::class );
$app->register( 'action', 'do', 'handle' );
$app->register( 'action', 'make', 'handle' );
$app->register( 'action', 'generate', 'handle' );
$app->register( 'action', 'list', 'handle' );
$app->register( 'action', 'show', 'handle' );
$app->register( 'action', 'next', 'handle' );
$app->register( 'action', 'previous', 'handle' );
$app->register( 'action', 'delete', 'handle' );
$app->register( 'action', 'help', 'handle' );

$app->delegate( 'api', APICommand::class );
$app->register( 'api', 'do', 'handle' );
$app->register( 'api', 'make', 'handle' );
$app->register( 'api', 'generate', 'handle' );
$app->register( 'api', 'list', 'handle' );
$app->register( 'api', 'show', 'handle' );
$app->register( 'api', 'next', 'handle' );
$app->register( 'api', 'previous', 'handle' );
$app->register( 'api', 'delete', 'handle' );
$app->register( 'api', 'help', 'handle' );

$app->delegate( 'info', EncyclopediaCommand::class );
$app->register( 'info', 'get', 'handle' );
$app->register( 'info', 'help', 'handle' );

$app->delegate( 'calc', CalculatorCommand::class );
$app->register( 'calc', 'do', 'handle' );
$app->register( 'calc', 'help', 'handle' );

$app->delegate( 'web', SearchCommand::class );
$app->register( 'web', 'find', 'handle' );
$app->register( 'web', 'get', 'handle' );
$app->register( 'web', 'next', 'handle' );
$app->register( 'web', 'previous', 'handle' );
$app->register( 'web', 'go', 'handle' );
$app->register( 'web', 'help', 'handle' );

$app->delegate( 'website', WebBrowserCommand::class );
$app->register( 'website', 'make', 'create' );
$app->register( 'website', 'open', 'browse' );
$app->register( 'website', 'show', 'viewPageContent' );
$app->register( 'website', 'list', 'listItems' );
$app->register( 'website', 'select', 'selectItem' );
$app->register( 'website', 'input', 'fillForm' );
$app->register( 'website', 'go', 'clickElement' );
$app->register( 'website', 'submit', 'submitForm' );
$app->register( 'website', 'previous', 'handle' );
$app->register( 'website', 'next', 'handle' );
$app->register( 'website', 'less', 'less' );
$app->register( 'website', 'more', 'more' );
$app->register( 'website', 'save', 'bookmark' );

$app->delegate( 'howto', HowToCommand::class );
$app->register( 'howto', 'find', 'search' );
$app->register( 'howto', 'show', 'show' );
$app->register( 'howto', 'help', 'help' );

$app->delegate( 'weather', WeatherCommand::class );
$app->register( 'weather', 'get', 'handle' );
$app->register( 'weather', 'help', 'handle' );

$app->delegate( 'news', NewsCommand::class );
$app->register( 'news', 'get', 'handle' );
$app->register( 'news', 'find', 'handle' );
$app->register( 'news', 'help', 'handle' );
$app->register( 'news', 'select', 'handle' );

// Simple Alias
$app->delegate( 'task', TodoCommand::class );
$app->register( 'task', 'add', 'tasks' );

$app->delegate( 'entity', EntityCommand::class );
$app->register( 'entity', 'do', 'handle' );
$app->register( 'entity', 'list', 'handle' );
$app->register( 'entity', 'get', 'handle' );
$app->register( 'entity', 'find', 'handle' );

$app->delegate( 'todo', TodoCommand::class );
$app->register( 'todo', 'list', 'handle' );
$app->register( 'todo', 'make', 'handle' );
$app->register( 'todo', 'add', 'handle' );
$app->register( 'todo', 'open', 'handle' );
$app->register( 'todo', 'select', 'handle' );
$app->register( 'todo', 'edit', 'handle' );
$app->register( 'todo', 'previous', 'handle' );
$app->register( 'todo', 'next', 'handle' );
$app->register( 'todo', 'delete', 'handle' );
$app->register( 'todo', 'find', 'handle' );
$app->register( 'todo', 'help', 'handle' );

$app->delegate( 'step', StepCommand::class );
$app->register( 'step', 'generate', 'perform' );
$app->register( 'step', 'update', 'perform' );
$app->register( 'step', 'list', 'perform' );
$app->register( 'step', 'show', 'perform' );
$app->register( 'step', 'get', 'perform' );
$app->register( 'step', 'set', 'perform' );
$app->register( 'step', 'add', 'perform' );
$app->register( 'step', 'delete', 'perform' );
$app->register( 'step', 'previous', 'perform' );
$app->register( 'step', 'next', 'perform' );
$app->register( 'step', 'help', 'perform' );

$app->delegate( 'schedule', ScheduleCommand::class );
$app->register( 'schedule', 'add', 'process' );
$app->register( 'schedule', 'list', 'process' );
$app->register( 'schedule', 'next', 'process' );
$app->register( 'schedule', 'previous', 'process' );
$app->register( 'schedule', 'delete', 'process' );
$app->register( 'schedule', 'edit', 'process' );
$app->register( 'schedule', 'help', 'process' );

$app->delegate( 'system', SystemResourceCommand::class );
$app->register( 'system', 'get', 'handle' );

$app->delegate( 'resource', ResourceCommand::class );
$app->register( 'resource', 'list', 'handle' );
$app->register( 'resource', 'next', 'handle' );
$app->register( 'resource', 'previous', 'handle' );
$app->register( 'resource', 'show', 'handle' );
$app->register( 'resource', 'more', 'showAll' );
$app->register( 'resource', 'help', 'handle' );

$app->delegate( 'user', UserCommand::class );
$app->register( 'user', 'list', 'handle' );
$app->register( 'user', 'find', 'handle' );
$app->register( 'user', 'update', 'handle' );
$app->register( 'user', 'help', 'handle' );
$app->register( 'user', 'prompt', 'handle' );
$app->register( 'user', 'get', 'handle' );

$app->delegate( 'variable', VariableCommand::class );
$app->register( 'variable', 'show', 'handle' );
$app->register( 'variable', 'list', 'handle' );
$app->register( 'variable', 'get', 'handle' );
$app->register( 'variable', 'set', 'handle' );
$app->register( 'variable', 'find', 'handle' );
$app->register( 'variable', 'previous', 'handle' );
$app->register( 'variable', 'next', 'handle' );
$app->register( 'variable', 'delete', 'handle' );
$app->register( 'variable', 'help', 'handle' );

$app->delegate( 'queue', QueueCommand::class );
$app->register( 'queue', 'add', 'handle' );
$app->register( 'queue', 'get', 'handle' );

$app->delegate( 'stack', StackCommand::class );
$app->register( 'stack', 'add', 'handle' );
$app->register( 'stack', 'get', 'handle' );

$app->delegate( 'file', FileCommand::class );
$app->register( 'file', 'make', 'handle' );
$app->register( 'file', 'edit', 'handle' );
$app->register( 'file', 'add', 'handle' );
$app->register( 'file', 'open', 'handle' );
$app->register( 'file', 'save', 'handle' );
$app->register( 'file', 'delete', 'handle' );
$app->register( 'file', 'list', 'handle' );
$app->register( 'file', 'find', 'handle' );
$app->register( 'file', 'help', 'handle' );

$app->delegate( 'note', NoteCommand::class );
$app->register( 'note', 'make', 'handle' );
$app->register( 'note', 'save', 'handle' );
$app->register( 'note', 'list', 'handle' );
$app->register( 'note', 'get', 'handle' );
$app->register( 'note', 'find', 'handle' );
$app->register( 'note', 'next', 'handle' );
$app->register( 'note', 'previous', 'handle' );
$app->register( 'note', 'help', 'handle' );

$app->delegate( 'ai', AICommand::class );
$app->register( 'ai', 'list', 'handle' );
$app->register( 'ai', 'show', 'handle' );
$app->register( 'ai', 'find', 'handle' );
$app->register( 'ai', 'get', 'handle' );
$app->register( 'ai', 'do', 'handle' );
$app->register( 'ai', 'help', 'handle' );

$app->delegate( 'transcript', MessageCommand::class );
$app->register( 'transcript', 'find', 'handle' );
$app->register( 'transcript', 'show', 'handle' );
$app->register( 'transcript', 'help', 'handle' );

$app->delegate( 'command', CommandHelper::class );
// $app->register( 'command', 'parse', 'parse' );
$app->register( 'command', 'list', 'list' );
$app->register( 'command', 'get', 'all' );
$app->register( 'command', 'next', 'next' );
$app->register( 'command', 'previous', 'previous' );
$app->register( 'command', 'help', 'help' );