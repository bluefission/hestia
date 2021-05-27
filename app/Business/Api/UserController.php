<?php
namespace App\Business\Api;

use BlueFission\Services\Service;
use App\Domain\User\Queries\IAllUsersQuery;

class UserController extends Service {

	public function index( IAllUsersQuery $query ) {

		$users = $query->fetch();

		response($users);
	}
}