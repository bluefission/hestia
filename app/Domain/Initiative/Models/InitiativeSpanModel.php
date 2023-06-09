<?php
namespace App\Domain\Initiative\Models;

use BlueFission\Framework\Model\ModelSql as Model;

class InitiativeSpanModel extends Model {
	
	const FINITE = "Finite Initiative Span";
	const INFINITE = "Infinite Initiative Span";
	const RECURRING = "Recurring Initiative Span";

	protected $_table = 'initiative_spans';
	protected $_fields = [
		'initiative_span_id',
		'name',
		'label',
		'description',
	];
}