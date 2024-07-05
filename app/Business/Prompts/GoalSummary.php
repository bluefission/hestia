<?php
namespace App\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class GoalSummary extends Prompt
{
	protected $_fields = ['input', 'dialogue'];
	protected $_template = "Previous prompt: \"{input}\"

{dialogue}

Given this conversation write a long, descriptive GPT prompt for the Chatbot that reminds it to solve the User's goals: ";
}