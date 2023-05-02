<?php
namespace App\Domain\Communication\Queries;

interface IUndeliveredCommunicationsQuery {
	public function fetch();
}