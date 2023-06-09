<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class Task extends ValueObject {
	public $task_id;
	public $initiative_id;
	public $kpi_type_id;
	public $task_status_id;

	public $description;
	public $quantity;
	public $duration;
	public $min;
	public $max;
}