<?php
namespace App\Domain\Conversation\Queries;

interface ITagsByTopicQuery {
	public function fetch($topic_id);
}