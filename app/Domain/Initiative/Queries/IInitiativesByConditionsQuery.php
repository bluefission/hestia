<?php
namespace App\Domain\Initiative\Queries;

interface IInitiativesByConditionsQuery {
	public function fetch($user_id);
}