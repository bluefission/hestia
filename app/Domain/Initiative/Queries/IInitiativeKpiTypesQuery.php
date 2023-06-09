<?php
namespace App\Domain\Initiative\Queries;

interface IInitiativeKpiTypesQuery {
	public function fetch($initiative_id);
}