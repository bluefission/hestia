<?php
namespace App\Business\Http\Api;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use App\Domain\User\Repositories\IUserRepository;

class UserController extends Service {

    public function find( $user_id, IUserRepository $repository ) {

        $user = $repository->find($user_id);
        return response($user);
    }
}