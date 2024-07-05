<?php
namespace App\Domain\Conversation;

use BlueFission\BlueCore\ValueObject;

class Tag extends ValueObject {
	public $tag_id;
	public $label;
}