<?php
namespace App\Domain\User\Queries;

use App\Domain\User\Queries\IAllUserQuery;

class AllUsersQuerySql implements IAllUsersQuery {
	public class function fetch() 
	{
		return [
			['username'=>'johndoe'],
			['username'=>'janedoe']
		];
	}
}