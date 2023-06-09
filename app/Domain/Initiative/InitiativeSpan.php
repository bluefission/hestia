<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class InitiativeSpan extends ValueObject {
	public $initiative_span_id;
	public $name;
	public $label;
	public $description;
}