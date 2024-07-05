<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;
use App\Domain\Initiative\Models\InitiativeToKpiTypeRelation;

class InitiativeModel extends Model {
	protected $_table = 'initiatives';
	protected $_fields = [
		'initiative_id',
		'parent_initiative_id',
		'initiative_type_id',
		'initiative_span_id',
		'initiative_privacy_type_id',
		'initiative_status_id',
		'unit_type_id',

		'name',
		'description',
		'budget',

		'start_date',
		'due_date',
		'delivery_date'
	];

	public function kpis()
	{
		// $model = new InitiativeToKpiTypeRelation;
		// $model->initiative_id = $this->initiative_id;
		// $model->read();
		// $data = $model->result();
		// return $data;
		return $this->children('App\Domain\Initiative\Models\InitiativeToKpiTypeRelation', 'initiative_id');
	}

	public function users()
	{
		
	}
}