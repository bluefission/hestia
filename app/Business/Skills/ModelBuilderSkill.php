<?php
// ModelBuilderSkill.php
namespace App\Business\Skills;

use BlueFission\Framework\Context;
use BlueFission\Framework\Skill\BaseSkill;
use BlueFission\Framework\Conversation\ModelBuilderConversation;

class ModelBuilderSkill extends BaseSkill
{
    protected $response;

    public function __construct()
    {
        parent::__construct('Model Builder');
    }

    public function execute(Context $context = null)
    {
        $botman = instance('botman');
        $conversation = new ModelBuilderConversation();
        $botman->startConversation($conversation);
        
        $this->response = ""; // Empty response since the conversation handles the reply
    }

    public function response(): string
    {
        return (string)$this->response;
    }
}
