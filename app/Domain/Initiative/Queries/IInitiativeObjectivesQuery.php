<?php
namespace App\Domain\Initiative\Queries;

interface IInitiativeObjectivesQuery {
	public function fetch($initiative_id);
}