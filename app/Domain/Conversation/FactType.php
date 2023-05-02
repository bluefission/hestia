<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class FactType extends ValueObject {
	public $fact_type_id;
	public $name;
	public $label;
}