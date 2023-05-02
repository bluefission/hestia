<?php
namespace App\Domain\Conversation\Queries;

interface IFactsByKeywordsQuery {
	public function fetch($input);
}