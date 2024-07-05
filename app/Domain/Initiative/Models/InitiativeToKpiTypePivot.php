<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class InitiativeToKpiTypePivot extends Model {
	protected $_table = ['initiative_to_kpi_type'];
	protected $_fields = [
		'initiative_id',
		'kpi_type_id',
	];
}