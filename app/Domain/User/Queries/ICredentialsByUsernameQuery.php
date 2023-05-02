<?php
namespace App\Domain\User\Queries;

interface ICredentialsByUsernameQuery {
	public function fetch($username);
}