<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class EntityType extends ValueObject {
	public $entity_type_id;
	public $name;
	public $label;
}