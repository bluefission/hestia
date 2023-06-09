<?php
namespace App\Domain\Initiative\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class InitiativePrivacyTypeModel extends Model {
	
	const PUBLIC = "Public Initiative Privacy Type";
	const PRIVATE = "Private Initiative Privacy Type";
	const HIDDEN = "Hidden Initiative Privacy Type";

	protected $_table = 'initiative_privacy_types';
	protected $_fields = [
		'initiative_privacy_type_id',
		'name',
		'label',
		'description',
	];
}