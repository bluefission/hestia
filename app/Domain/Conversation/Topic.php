<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class Topic extends ValueObject {
	public $topic_id;
	public $name;
	public $label;
	public $weight;
}