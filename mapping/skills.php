<?php
use BlueFission\Framework\Skill\Intent\Intent;
use BlueFission\Framework\Skill\Intent\Context;
use App\Business\Skills\GreetingResponseSkill;
use App\Business\Skills\GoodbyeResponseSkill;
use App\Business\Skills\StatusSkill;
use App\Business\Skills\HowAreYouResponseSkill;
use App\Business\Skills\TimeAndDateSkill;
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


// New intent and skill registration for GoodbyeResponseSkill
$goodbyeIntent = new Intent('goodbye.response', 'Goodbye Response', [
    'keywords' => [
        ['word' => 'good night', 'priority' => 4.0],
        ['word' => 'goodbye', 'priority' => 4.0],
        ['word' => 'bye', 'priority' => 4.0],
        ['word' => 'see you later', 'priority' => 3.0],
        ['word' => 'take care', 'priority' => 3.0],
    ],
]);

$goodbyeSkill = new GoodbyeResponseSkill();

$skills
    ->registerSkill($goodbyeSkill)
    ->registerIntent($goodbyeIntent)
    ->associate($goodbyeIntent, $goodbyeSkill);

// New intent and skill registration for HowAreYouResponseSkill
$howAreYouIntent = new Intent('howareyou.response', 'How Are You Response', [
    'keywords' => [
        ['word' => 'how are you', 'priority' => 7.0],
        ['word' => 'how is it going', 'priority' => 4.0],
        ['word' => 'how are things', 'priority' => 3.0],
        ['word' => 'how do you feel', 'priority' => 2.0],
        ['word' => 'are you okay', 'priority' => 2.0],
    ],
]);

$howAreYouSkill = new HowAreYouResponseSkill();

$skills
    ->registerSkill($howAreYouSkill)
    ->registerIntent($howAreYouIntent)
    ->associate($howAreYouIntent, $howAreYouSkill);


// New intent and skill registration for UpdateSkill
$updateIntent = new Intent('status.skill', 'Update Skill', [
    'keywords' => [
        ['word' => 'what\'s up', 'priority' => 4.0],
        ['word' => 'what\'s going on', 'priority' => 4.0],
        ['word' => 'what\'s your status', 'priority' => 5.0],
        ['word' => 'give me an update', 'priority' => 7.0],
    ],
]);

$updateSkill = new StatusSkill();

$skills
    ->registerSkill($updateSkill)
    ->registerIntent($updateIntent)
    ->associate($updateIntent, $updateSkill);

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


// New intent and skill registration for TimeAndDateSkill
$timeAndDateIntent = new Intent('timeanddate.response', 'Time And Date Response', [
    'keywords' => [
        ['word' => 'what is the time', 'priority' => 3.0],
        ['word' => 'what time is it', 'priority' => 3.0],
        ['word' => 'tell me the time', 'priority' => 2.0],
        ['word' => 'current time', 'priority' => 2.0],
        ['word' => 'what is the date', 'priority' => 3.0],
        ['word' => 'what date is it', 'priority' => 3.0],
        ['word' => 'tell me the date', 'priority' => 2.0],
        ['word' => 'current date', 'priority' => 2.0],
    ],
]);

$timeAndDateSkill = new TimeAndDateSkill();

$skills
    ->registerSkill($timeAndDateSkill)
    ->registerIntent($timeAndDateIntent)
    ->associate($timeAndDateIntent, $timeAndDateSkill);
