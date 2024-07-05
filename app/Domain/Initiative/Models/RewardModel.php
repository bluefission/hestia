<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class RewardModel extends Model {
	protected $_table = 'rewards';
	protected $_fields = [
		'reward_id',
		'initiative_id',
		'attribute_id',
		'operator_id',
		'unit_type_id',
		'value',
	];
}