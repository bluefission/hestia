<?php
namespace App\Domain\Conversation;

use BlueFission\BlueCore\ValueObject;

class Entity extends ValueObject {
	public $entity_id;
	public $name;
	public $label;
}