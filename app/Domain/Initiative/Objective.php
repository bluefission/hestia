<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class Objective extends ValueObject {
	public $objective_id;
	public $initiative_id;
	public $kpi_type_id;
	public $operator_id;
	public $unit_type_id;
	public $value;
}