<?php

namespace App\Business\Managers;

use BlueFission\Services\Service;
use BlueFission\Connections\Database\MysqlLink;
use App\Domain\User\Models\UserModel;
use App\Domain\User\Models\CredentialModel;

class UserManager extends Service
{
    public function __construct(MysqlLink $link)
    {
        $this->_link = $link;
        parent::__construct();
    }

    public function create(array $userData)
    {
        $user = new UserModel($this->_link);
        $credential = new CredentialModel($this->_link);

        $user->realname = $userData['realname'];
        $user->displayname = $userData['displayname'];

        $credential->username = $userData['username'];
        $credential->password = $userData['password'];

        $credential->password = password_hash($credential->password, PASSWORD_DEFAULT);

        $user->write();
        $user->read();
        $credential->user_id = $user->id();
        $credential->write();

        tell($credential->status());
    }

    public function changePassword($username, $newPassword)
    {
        $credential = new CredentialModel($this->_link);

        $credential->username = $username;
        $credential->read();

        if (!$credential->id()) {
            tell("User not found.");
            return;
        }

        $credential->password = password_hash($newPassword, PASSWORD_DEFAULT);
        $credential->write();

        tell($credential->status());
    }
}
