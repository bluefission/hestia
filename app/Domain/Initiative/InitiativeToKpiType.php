<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class InitiativeToKpiType extends ValueObject {
	public $initiative_id;
	public $kpi_type_id;
}