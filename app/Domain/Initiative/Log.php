<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class Log extends ValueObject {
	public $log_id;
	public $user_id;
	public $initiative_id;
	public $kpi_type_id;
	public $quantity;
	public $cost;
	public $note;
	public $start;
	public $duration;
}