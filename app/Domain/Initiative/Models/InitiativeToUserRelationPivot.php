<?php
namespace App\Domain\Initiative\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class InitiativeToUserRelationPivot extends Model {
	protected $_table = ['initiative_to_user'];
	protected $_fields = [
		'initiative_id',
		'user_id',
	];
}