<?php
namespace App\Domain\Conversation;

use BlueFission\Framework\ValueObject;

class TopicRoute extends ValueObject {
	public $context_route_id;
	public $from;
	public $to;
	public $weight;
}