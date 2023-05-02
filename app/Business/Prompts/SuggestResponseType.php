<?php
namespace App\Business\Prompts;

use BlueFission\Framework\Chat\Prompt;

class SuggestResponseType extends Prompt
{
	protected $_fields = ['history'];
	protected $_template = "{history}

Given the previous conversation, should the Chatbot respond by speaking, examining the situation, or by doing something?

(You should always observe before dialogue or actions, you shouldn't have dialogue back to back, there shouldn't be dialogue until major actions have been accomplished, and actions generally come right after one another).

Once the final answer to the User's question is found or the task has been accomplished, the response type should always be 'dialogue'.

Best Response Type (type either dialogue, observation, or action): ";

// 	protected $_template = "Respond to the following Input in a way that best serves the User's immediate goal. You only have access to the following resources:
            
// {resources}

// Suggest the Commands and Statements most likely to move goals forward. Update the User before launching commands. Give up on commands that don't seem to be moving forward, and keep from repeating commands, and use the help output and suggestions from system responses and previous commands. You can combine commands to get more done (ex: browse the web then then scroll through results then then open a website then then make a note on what you find). 

// Reminders:
//     - You must store and access variables, todos, and notes often to get access to extended memory
//     - The System responses always give feedback on if your commands were successful ('Command triggered with no response' means your command probably failed)
//     - You should always follow-up on your last command (e.g.if you list variables you should select them, if you search the web you should scroll through result pages)

// Assessment types: 
//     - Respond to the User with conversation (ex: Say: \"I will look into that for you!\")
//     - Suggest actions (ex: The best resource to respond with is [resource name] with command `help with [resource name]`)
//     - Give hints (ex: Use the System response hints to build off of the last command)

// This is the format to use:
//     Input: The question or statement to respond to
//     History: The last several turns of the conversation
//     Objective: What the user ultimately wants to accomplish
//     Assessment: The next logical statement or command to follow up on based on user goals and system prompts

// Begin!

// Question: {input}
// History: {history}
// Objective: {goal}
// Assessment: ";
}