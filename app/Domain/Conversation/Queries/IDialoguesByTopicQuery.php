<?php
namespace App\Domain\Conversation\Queries;

interface IDialoguesByTopicQuery {
	public function fetch($topic_id);
}