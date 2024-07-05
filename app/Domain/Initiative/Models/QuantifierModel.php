<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class QuantifierModel extends Model {
	protected $_table = 'quantifiers';
	protected $_fields = [
		'quantifier_id',
		'name',
		'label',
		'description',
	];
}