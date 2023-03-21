<?php
use BlueFission\Framework\Engine as App;

$app = App::instance();

$app->register( 'skill', 'do', 'runSkill' );