<?php
namespace App\Business\Api\Admin;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use App\Domain\User\Repositories\IUserRepository;
use App\Domain\User\Queries\IAllUsersQuery;
use App\Domain\User\User;

class UserController extends Service {

    public function index( IAllUsersQuery $query ) {

        $users = $query->fetch();
        return response($users);
    }

    public function find( Request $request, IUserRepository $repository ) {

        $id = $request->id;
        $user = $repository->find($id);
        return response($user);
    }

	public function save( Request $request, IUserRepository $repository )
    {
        // Create new user model
        $user = new User;
        $user->username = $request->username;
        $user->displayname = $request->displayname;

        // Save the new user
        $repository->write($user);

        // Return the id
        return response(['id' => $user->id]);
    }

    public function updateCredentials( Request $request, MysqlLink $link )
    {
        $link->open();
        $link->update('credentials', ['password'=>sha1($password)], 'credential_id='.$id);
    }
}