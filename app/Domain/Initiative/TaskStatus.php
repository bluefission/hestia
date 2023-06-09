<?php
namespace App\Domain\Initiative;

use BlueFission\Framework\ValueObject;

class TaskStatus extends ValueObject {
	public $task_status_id;
	public $name;
	public $label;
	public $description;
}