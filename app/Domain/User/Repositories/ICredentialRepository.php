<?php
namespace App\Domain\User\Repositories;

use App\Domain\User\Credential;
use App\Domain\User\Models\CredentialModel;

interface ICredentialRepository
{
    public function find($id);
    public function save(Credential $credential);
    public function remove(Credential $credential);
}