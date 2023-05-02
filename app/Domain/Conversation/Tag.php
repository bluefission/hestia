<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class Tag extends ValueObject {
	public $tag_id;
	public $label;
}