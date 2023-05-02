<?php
namespace App\Domain\Conversation\Queries;

interface IDialoguesByKeywordsQuery {
	public function fetch($phrase);
}