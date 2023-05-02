<?php
namespace App\Business\Prompts;

use BlueFission\Framework\Chat\Prompt;

class TruthCorrection extends Prompt
{
	protected $_fields = ['input', 'reason', 'dialogue'];
	protected $_template = "{dialogue}

Next planned Chatbot response: {input}

Reason for falsiness: {reason}

The Chatbot's next planned response contains inaccuracies, misinformation, falsehoods, or made up facts. It may be attributing it's own actions (commands, searches) to the User. Rephrase the response such that it corrects the problems pointed out in the reason above, reflects objective truths and evidence proven by actions and responses/reactions to those actions from either the User or the System and removes made up information, honestly acknowledge the truth, and admit when you're wrong or stumped. Corrected factual statement with only information from the conversation - 
[Chatbot]: ";
}