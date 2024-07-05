<?php
namespace App\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class DebunkAnalysis extends Prompt
{
	protected $_fields = ['input', 'dialogue'];
	protected $_template = "{dialogue}

	Next planned Chatbot response: {input}

    Consider if the Chatbot's next response reflects anything that exists in the conversation log or is made up. Also consider if the response reflects rigor that isn't evidenced with work or actions. Penalize for inaccuracy or facts that were never introduced beforehand. Don't punish reasonable assumptions, implied truths, or common sense. Now, based on evidence from the System's responses and User's feedback and the proof or contradictions demonstated, provide a brief explaination of why this statement is false with detailed outlined examples: ";
}