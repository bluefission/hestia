<?php
namespace App\Domain\Initiative\Queries;

interface IInitiativesByPrerequisitesQuery {
	public function fetch($user_id);
}