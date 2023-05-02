<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class Definition extends ValueObject {
	public $defintition_id;
	public $entity_id;
	public $property;
	public $verb_id;
	public $value;
}