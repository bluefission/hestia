<?php
namespace App\Business\Api;

use BlueFission\Services\Service;
use App\Domain\User\Queries\IAllUsersQuery;
use App\Domain\User\User;

class UserController extends Service {

	public function index( IAllUsersQuery $query ) {

		$users = $query->fetch();

		response($users);
	}

	public function insert( Request $request, IUserRepository $repository )
    {
        // Create new user model
        $user = new User;
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->gender = $_POST['gender'];
        $user->email = $_POST['email'];

        // Save the new user
        $repository->write($user);

        // Return the id
        return response(['id' => $user->id]);
    }
}