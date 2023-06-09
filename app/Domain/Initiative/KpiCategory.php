<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class KpiCategory extends ValueObject {
	public $kpi_category_id;
	public $name;
	public $label;
	public $description;
}