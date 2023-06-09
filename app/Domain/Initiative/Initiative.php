<?php
namespace AddOns\Initiative\Domain;

use BlueFission\Framework\ValueObject;

class Initiative extends ValueObject {
	public $initiative_id;
	public $parent_initiative_id;
	public $initiative_type_id;
	public $initiative_span_id;
	public $initiative_privacy_type_id;
	public $initiative_status_id;
	public $unit_type_id;

	public $name;
	public $description;
	public $budget;

	public $start_date;
	public $due_date;
	public $delivery_date;
}