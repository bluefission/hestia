<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class Entity extends ValueObject {
	public $entity_id;
	public $name;
	public $label;
}