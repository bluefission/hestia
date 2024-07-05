<?php
namespace App\Domain\Conversation;

use BlueFission\BlueCore\ValueObject;

class EntityType extends ValueObject {
	public $entity_type_id;
	public $name;
	public $label;
}