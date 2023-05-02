<?php
namespace App\Business\Prompts;

use BlueFission\Framework\Chat\Prompt;

class DifficultyScore extends Prompt
{
	protected $_fields = ['input'];
	protected $_template = "{input}

Considering the tasks or goals mentioned in the previous text, please estimate the difficulty/complexity score on a scale from 1 to 100: ";
}