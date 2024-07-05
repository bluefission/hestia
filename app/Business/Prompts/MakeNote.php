<?php
namespace App\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class MakeNote extends Prompt
{
	protected $_fields = ['input', 'chathistory'];
	protected $_template = "Chat History:
{chathistory}

Topic: {input}

Given the chat history, write an informative list, long summary, or 3 paragraph explanation pertaining to only the information in the topic: ";
}