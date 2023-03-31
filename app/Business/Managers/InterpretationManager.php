<?php
namespace App\Business\Managers;

use BlueFission\Services\Service;
use BlueFission\Data\Storage\Session;
use BlueFission\Framework\Command\CommandProcessor;
use BlueFission\Framework\Skill\Intent\Context;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class InterpretationManager extends Service {

	public function __construct(CommandProcessor $commandProcessor, Context $context)
	{
		$this->commandProcessor = $commandProcessor;
		$this->context = $context;

		parent::__construct();
	}

	public function process(IncomingMessage $message)
	{
	    $intentScores = $message->getExtras('intent_scores');
	    $command = $message->getExtras('command');
	    $response = "";

	    if ( !empty($intentScores) && array_values($intentScores)[0] > 5 ) {
		    // Instantiate the SkillManager and process the message using the highest scored intent
		    $skills = \App::instance()->service('skill');
		    $highestScoredIntent = array_search(max($intentScores), $intentScores);

		    $this->context->set('username', $message->getSender());
		    $this->context->set('message', $message->getText());

		    $response = $skills->process($highestScoredIntent, $this->context);
		}

		else {
			
	        $commandString = "";
	        if ( isset($command['operator']) ) {
	            $commandString = $command['operator'];
	        } else if (!empty($command['objects'])) {
	            $commandString = "do";
	        }
	        if ( !empty($command['objects']) ) {
	            foreach ($command['objects'] as $object) {
	                $commandString .= " $object";
	            }
	        }
	        $commandString = trim($commandString);
	        $response = $commandString;

	        // $response = $this->command($commandString);
		}

		return $response;
	}

    protected function command($input) {
        $sessionStorage = new Session(['location'=>'cache','name'=>'system']);
        $commandProcessor = new CommandProcessor($sessionStorage);

        $response = $commandProcessor->process($input);
        return $response;
    }
}