<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class KpiType extends ValueObject {
	public $kpi_type_id;
	public $kpi_category_id;
	public $unit_type_id;
	public $name;
	public $label;
	public $description;
}