<?php
namespace App\Domain\Conversation\Queries;

interface ITopicRoutesByTopicQuery {
	public function fetch($topic_id);
}