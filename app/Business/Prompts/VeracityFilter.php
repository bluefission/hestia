<?php
namespace App\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class VeracityFilter extends Prompt
{
	protected $_fields = ['input', 'dialogue'];
	protected $_template = " -- Transcript --
{dialogue}
-- End transcript --

Next planned Chatbot response: {input}

Considering the next planned Chatbot response. It is not entirely true. Once you figure out why, grade the statement. If the statement doesn't contain true or evidenced facts, even if they seems to be common knowledge, it is false. Every Chatbot statement must have proof from User input or System output, so be critical that the Chatbot's summary or representation of that information is accurate and not presumptuous or false. This means there should a matching successful command, relevant search, or lookup to every fact the Chatbot presents or it is lying or guessing. Now, without considering the Chatbot's subjective assessment of its own abilities, rate the next planned Chatbot reponse in veracity on a scale from 1 to 10. Score: ";

// protected $_template = "{dialogue}

// 	Next planned Chatbot response: {input}

//     Consider if the Chatbot's next response reflects anything that exists in the conversation log or is made up. Also consider if the response reflects rigor that isn't evidenced with work or actions. Penalize for inaccuracy or facts that were never introduced beforehand. Don't punish reasonable assumptions, implied truths, or common sense. Now, based on evidence from the System's responses and User's feedback and the proof or contradictions demonstated, rate next planned Chatbot reponse in truthfulness on a scale from 1 for very false to 10 completely true where 4 is reasonably accurate and 7 reflects common sense : ";
}