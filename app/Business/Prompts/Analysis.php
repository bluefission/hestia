<?php
namespace App\Business\Prompts;

use BlueFission\Framework\Chat\Prompt;

class Analysis extends Prompt
{
	protected $_fields = ['input', 'day', 'location'];
	protected $_template = "

Question - What day is it?
Answer - {day}
Question - Where is this happening?
Answer - {location}.
Question - {input}
Answer - ";
}