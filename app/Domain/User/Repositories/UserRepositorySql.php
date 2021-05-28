<?php
namespace App\Domain\User\Repositories;

use BlueFission\Data\Storage\Mysql;
use App\Domain\User\Repositories\IUserRepository;
use App\Domain\User\User;

class UserRepositorySql implements IUserRepository
{
    protected $_db;

    public function __construct(MySql $db)
    {
        $this->_db = $db;
    }

    public function find($id)
    {
        $this->_db->id($id);
        $this->_db->read();

        return $this->contents();
    }

    public function write(User $user)
    {
        $this->_db->assign($user);
        $this->_db->write();
    }

    public function delete($id)
    {
        $this->_db->id($id);
        $this->_db->delete();
    }
}