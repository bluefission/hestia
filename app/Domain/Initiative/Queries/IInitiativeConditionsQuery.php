<?php
namespace App\Domain\Initiative\Queries;

interface IInitiativeConditionsQuery {
	public function fetch($initiative_id);
}