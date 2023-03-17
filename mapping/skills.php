<?php
return;

use BlueFission\Framework\Skill\Intent\Intent;
use BlueFission\Framework\Skill\Intent\Context;
use App\Business\Skills\GreetUserSkill;

$skills = App::instance()->service('skills');

$greetingIntent = new Intent('greet_user', [
    'keywords' => [
        ['word' => 'hello', 'priority' => 1.0],
        ['word' => 'good morning', 'priority' => 1.0],
        ['word' => 'good evening', 'priority' => 1.0],
    ],
    'context' => new Context('greeting', 'user1')
]);

$skills->register(new GreetUserSkill, 'intent', 'example', 'context');

$input = [
    'inputKeywords' => ['good morning'],
    'inputContext' => new Context('greeting', 'user1'),
    'prompt' => 'John',
];

// $response = $skills->execute($input);