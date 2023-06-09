<?php
namespace App\Domain\Initiative\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class InitiativeToKpiTypeRelationPivot extends Model {
	protected $_table = ['initiative_to_kpi_type'];
	protected $_fields = [
		'initiative_id',
		'kpi_type_id',
	];
}