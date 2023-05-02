<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class EntityToEntityTypes extends ValueObject {
	public $entity_id;
	public $entity_type_id;
	public $weight;
}