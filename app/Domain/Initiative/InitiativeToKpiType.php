<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class InitiativeToKpiType extends ValueObject {
	public $initiative_id;
	public $kpi_type_id;
}