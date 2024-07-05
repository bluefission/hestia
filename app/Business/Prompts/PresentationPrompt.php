<?php 
namespace App\Business\Prompts;

use BlueFission\Automata\LLM\Prompt;

class PresentationPrompt extends Prompt
{
	protected $_fields = ['input'];
	protected $_template = "{input}
Create an outline for a keynote slide show of 8 slides that presents the premise above in an organized and compelling way. 
1. {=slide_1 [stop: '\\n', max_tokens: '20']}
2. {=slide_2 [stop: '\\n', max_tokens: '20']}
3. {=slide_3 [stop: '\\n', max_tokens: '20']}
4. {=slide_4 [stop: '\\n', max_tokens: '20']}
5. {=slide_5 [stop: '\\n', max_tokens: '20']}
6. {=slide_6 [stop: '\\n', max_tokens: '20']}
7. {=slide_7 [stop: '\\n', max_tokens: '20']}
8. {=slide_8 [stop: '\\n', max_tokens: '20']}

Now, can you provide a fitting title for the presentation based on the above outline 
{=title [stop: '', max_tokens: '120']}

And a suitable subtitle that further explains the main theme? 
{=subtitle [stop: '', max_tokens: '120']}";
}