<?php
// GreetingResponseSkill.php
namespace App\Business\Skills;

use BlueFission\Framework\Skill\Intent\Context;
use BlueFission\Framework\Skill\BaseSkill;

class GreetingResponseSkill extends BaseSkill
{
    protected $response;

    public function __construct()
    {
        parent::__construct('Greeting Response');
    }

    public function execute(Context $context = null)
    {
        $hour = date('H');
        $greeting = '';
        $name = null;
        if ($context) {
            $name = $context->get('username');
        }

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good morning';
        } elseif ($hour >= 12 && $hour < 18) {
            $greeting = 'Good afternoon';
        } elseif ($hour >= 18 || $hour < 5) {
            $greeting = 'Good evening';
        }

        if ($name) {
            $this->response = "{$greeting}, {$name}!";
        } else {
            $this->response = "{$greeting}!";
        }
    }

    public function response(): string
    {
        return $this->response;
    }
}
