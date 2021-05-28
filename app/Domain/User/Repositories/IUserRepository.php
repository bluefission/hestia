<?php
namespace App\Domain\User\Repositories;

use App\Domain\User\User;
use App\Domain\User\Models\UserModel;

interface IUserRepository
{
    public function find($id);
    public function save(User $user);
    public function remove(User $user);
}