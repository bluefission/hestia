<?php
use BlueFission\Framework\Skill\Intent\Intent;
use BlueFission\Framework\Skill\Intent\Context;
use App\Business\Skills\GreetingResponseSkill;
use App\Business\Skills\ModelBuilderSkill;

$skills = App::instance()->service('skill');

$greetingIntent = new Intent('greeting.response', 'Greeting Response', [
    'keywords' => [
        ['word' => 'good morning', 'priority' => 3.0],
        ['word' => 'good afternoon', 'priority' => 3.0],
        ['word' => 'good evening', 'priority' => 3.0],
        ['word' => 'hello', 'priority' => 4.0],
        ['word' => 'hi', 'priority' => 4.0],
    ],
]);

$greetingSkill = new GreetingResponseSkill();

$skills
    ->registerSkill($greetingSkill)
    ->registerIntent($greetingIntent)
    ->associate($greetingIntent, $greetingSkill);

$modelBuilderIntent = new Intent('model.builder', 'Model Builder', [
    'keywords' => [
        ['word' => 'Machine Learning', 'priority' => 6.0],
        ['word' => 'AI Model', 'priority' => 1.0],
        ['word' => 'Deep Learning', 'priority' => 2.0],
        ['word' => 'Neural Net', 'priority' => 2.0],
        ['word' => 'SageMaker', 'priority' => 2.0],
        ['word' => 'Model', 'priority' => 1.0],
        ['word' => 'Generate', 'priority' => 2.0],
    ],
]);

$modelBuilderSkill = new ModelBuilderSkill();

$skills
    ->registerSkill($modelBuilderSkill)
    ->registerIntent($modelBuilderIntent)
    ->associate($modelBuilderIntent, $modelBuilderSkill);