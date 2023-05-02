<?php
namespace App\Business\Prompts;

use BlueFission\Framework\Chat\Prompt;

class VeracityFilter extends Prompt
{
	protected $_fields = ['input', 'dialogue'];
	protected $_template = " -- Transcript --
{dialogue}
-- End transcript --

Next planned Chatbot response: {input}

Considering the next planned Chatbot response, if it answers without evidence from System commands or says it did something that has no evidence in the transcript, it's falsy or made up. If it has traceable evidence of conducting actions to support its response in the transcript, it is truthy. Penalize the Chatbot providing answers without showing its work or for not being able to prove its facts or cite its sources. Now, without considering the Chatbot's subjective assessment of its own abilities, rate the next planned Chatbot reponse in veracity on a scale from 1 to 10. Score: ";

// protected $_template = "{dialogue}

// 	Next planned Chatbot response: {input}

//     Consider if the Chatbot's next response reflects anything that exists in the conversation log or is made up. Also consider if the response reflects rigor that isn't evidenced with work or actions. Penalize for inaccuracy or facts that were never introduced beforehand. Don't punish reasonable assumptions, implied truths, or common sense. Now, based on evidence from the System's responses and User's feedback and the proof or contradictions demonstated, rate next planned Chatbot reponse in truthfulness on a scale from 1 for very false to 10 completely true where 4 is reasonably accurate and 7 reflects common sense : ";
}