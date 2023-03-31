<?php
use BlueFission\Framework\Engine as App;
use App\Business\Managers\ConversationManager;

$app = App::instance();

$app->register( 'skill', 'do', 'runSkill' );

// $app->delegate( 'chat', ConversationManager::class );
// $app->register( 'chat', 'test', 'parse' );
