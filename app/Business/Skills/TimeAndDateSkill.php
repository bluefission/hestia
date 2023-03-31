<?php
// TimeAndDateSkill.php
namespace App\Business\Skills;

use BlueFission\Framework\Skill\Intent\Context;
use BlueFission\Framework\Skill\BaseSkill;
use BlueFission\Utils\DateTime;

class TimeAndDateSkill extends BaseSkill
{
    protected $response;

    public function __construct()
    {
        parent::__construct('Time and Date');
    }

    public function execute(Context $context = null)
    {
        $dateTimeUtil = new DateTime();
        $message = strtolower($context->get('message'));
        $responseParts = [];

        if (strpos($message, 'time') !== false) {
            $currentTime = $dateTimeUtil->time();
            $responseParts[] = "The current time is {$currentTime}";
        }

        if (strpos($message, 'date') !== false) {
            $currentDate = $dateTimeUtil->date();
            $responseParts[] = "The current date is {$currentDate}";
        }

        if (strpos($message, 'zone') !== false) {
            $timeZone = $dateTimeUtil->config('timezone');
            $responseParts[] = "The time zone is {$timeZone}";
        }

        if (empty($responseParts)) {
            $currentTime = $dateTimeUtil->time();
            $responseParts[] = "The current time is {$currentTime}";
        }

        $this->response = implode(', ', $responseParts) . '.';
    }

    public function response(): string
    {
        return $this->response;
    }
}
