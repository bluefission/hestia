<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class Language extends ValueObject {
	public $language_id;
	public $name;
	public $label;
}