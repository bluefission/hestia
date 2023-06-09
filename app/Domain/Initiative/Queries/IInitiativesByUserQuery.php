<?php
namespace App\Domain\Initiative\Queries;

interface IInitiativesByUserQuery {
	public function fetch($user_id);
}