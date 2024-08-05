<?php
namespace App\Business\Managers;

use BlueFission\Services\Service;
use BlueFission\Data\Storage\Session;
// use BlueFission\Wise\Cmd\CommandProcessor;
use BlueFission\Automata\Context;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class InterpretationManager extends Service {

	private $context = false;
	private $continue = false;
	public function __construct(Context $context)
	{
		// $this->commandProcessor = $commandProcessor;
		$this->context = $context;

		parent::__construct();
	}

	public function process(IncomingMessage $message = null)
	{
		$isAdmin = false;

		$responses = [];
		if ($message) {
		    $intentScores = $message->getExtras('intent_scores');
		    // $command = $message->getExtras('command');
		    $insights = $message->getExtras('intelligence_output');
		    $this->context->set('username', $message->getSender());
		    $this->context->set('message', $message->getText());

		    if ( !empty($intentScores) && array_values($intentScores)[0] > 80 ) {
		    	tell(array_keys($intentScores)[0].' '.array_values($intentScores)[0], 'botman');
			    // Instantiate the SkillManager and process the message using the highest scored intent
			    $skills = instance('skill');
			    $highestScoredIntent = array_search(max($intentScores), $intentScores);

			    $response = $skills->process($highestScoredIntent, $this->context);
			    if ($response) {
			    	$responses[] = $response;
			    }
			} elseif ($isAdmin) { // always false for now
				
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

		        $responses[] = $this->command($commandString);
			}
		}

	    $replies = $this->converse($message, $responses);

		return $replies;
	}

	public function continue()
	{
		return $this->continue;
	}

    protected function command($input) {
        // $sessionStorage = new Session(['location'=>'cache','name'=>'system']);
        // $commandProcessor = new CommandProcessor($sessionStorage);
        // $response = $commandProcessor->process($input);

    	$core = instance('core');
    	$core->handle('input');
    	$response = $core->output();

        return $response;
    }

    protected function converse($message = null, $responses = [])
    {
    	$replies = [];
	    $convo = instance('convo');

	    if ($message) {
	    	$convo->resetDepth();
		    if (count($responses)) {
			    foreach ($responses as $response) {
			    	$newReplies = $convo->process($message->getText(), $this->context, $response);
			    	$replies = array_merge($replies, $newReplies);
			    }
			} elseif (isset($response) && !empty($response)) {
				$replies = $convo->process($message->getText(), $this->context, $response);
			} else {
				$replies = $convo->process($message->getText(), $this->context);
			}

			if ( empty($replies) ) {
				$replies = $responses;
			}
		} else {
			$replies = $convo->process("", $this->context);
		}
		$this->continue = $convo->continue();

		return $replies;
    }
}