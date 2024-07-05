<?php
namespace App\Domain\Initiative;

use BlueFission\BlueCore\ValueObject;

class TaskStatus extends ValueObject {
	public $task_status_id;
	public $name;
	public $label;
	public $description;
}