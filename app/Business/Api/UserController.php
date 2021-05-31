<?php
namespace App\Business\Api;

use BlueFission\Services\Service;
use BlueFission\Services\Request;
use App\Domain\User\Repositories\IUserRepository;

class UserController extends Service {

    public function find( Request $request, IUserRepository $repository ) {

        $id = $request->id;
        $user = $repository->find($id);
        return response($user);
    }
}