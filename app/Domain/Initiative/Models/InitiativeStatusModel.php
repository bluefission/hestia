<?php
namespace App\Domain\Initiative\Models;

use BlueFission\BlueCore\Model\ModelSql as Model;

class InitiativeStatusModel extends Model {
	const ACTIVE = "Active Initiative Status";
	const COMPLETED = "Completed Initiative Status";
	const PAUSED = "Paused Initiative Status";
	const CANCELED = "Canceled Initiative Status";
	const FAILED = "Failed Initiative Status";
	const PARKED = "Parked Initiative Status";

	protected $_table = 'initiative_statuses';
	protected $_fields = [
		'initiative_status_id',
		'name',
		'label',
		'description',
	];
}