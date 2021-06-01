<?php
namespace App\Business\Api\Admin;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use BlueFission\Connections\Database\MysqlLink;
use App\Domain\User\Models\CredentialModel;
use App\Domain\User\Repositories\IUserRepository;
use App\Domain\User\Queries\IAllUsersQuery;
use App\Domain\User\User;


class UserController extends Service {

    public function __construct( MysqlLink $link )
    {
        parent::__construct();
        $link->open();
    }

    public function index( IAllUsersQuery $query ) {

        $users = $query->fetch();
        return response($users);
    }

    public function find( Request $request, IUserRepository $repository ) {

        $user_id = $request->user_id;
        $user = $repository->find($user_id);
        return response($user);
    }

	public function save( Request $request, IUserRepository $repository )
    {
        // Create new user model
        $user = new User;
        $user->user_id = $request->user_id;
        $user->username = $request->username;
        $user->displayname = $request->displayname;

        // Save the new user
        $repository->save($user);

        // Return the id
        return response(['user_id' => $user->user_id]);
    }

    public function updateCredentials( Request $request, CredentialModel $credential )
    {
        $credential->credential_id = $request->credential_id;
        $credential->read();

        $password = $request->password;
        $password_confirm = $request->password_confirm;

        if ($password != $password_confirm) {
            return response("Passwords do not match");
        }
        
        $credential->password = password_hash($password, PASSWORD_DEFAULT);
        $credential->write();

        return response($credential->response());
    }
}