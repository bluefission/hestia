<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class Message extends ValueObject {
	public $message_id;
	public $conversation_id;
	public $user_id;
	public $topic_id;
	public $communication_id;
	public $private;
}