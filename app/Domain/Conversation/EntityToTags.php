<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class EntityToTags extends ValueObject {
	public $entity_id;
	public $tag_id;
	public $weight;
}