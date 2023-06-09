<?php 
namespace App\Business\Prompts;

use BlueFission\Framework\Chat\Prompt;

class SocialPostPrompt extends Prompt
{
	protected $_fields = ['input'];
	protected $_template = "{input}
{#var platforms = ['Facebook', 'LinkedIn', 'Twitter', 'TikTok']}
Which social media platform is the above text best to post on? {=platform [stop: ',', options: platforms]}

{#if(platform=='Facebook')}Should it be posted on a wall or in a group? {=location [stop: '\\n', options: ['Wall', 'Group']]}{#endif}
{#if(platform=='Twitter')}Recommend an appropriate hashtag for this post? {=hashtag}{#endif}

Add good short example comments to follow up with on this post:
{#each [iterations:'5', glue:', ']}{=comments [max_tokens: '120']}
Notes: {=notes}

{#endeach}

How should it best be phrased for each platform?
{#each items=platforms}
{@index}. {@current}: \"{=@current [stop: '\"', max_tokens: '120']}\"{#endeach}";
}