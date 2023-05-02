<?php
namespace App\Business\Prompts;

use BlueFission\Framework\Chat\Prompt;

class CreateMathExpression extends Prompt
{
	protected $_fields = ['input'];
	protected $_template = "\"{input}\"

write the numerical mathematical equation that solves the problem in the phrase above: x = ";
}