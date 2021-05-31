<?php
namespace App\Domain\User\Repositories;

use BlueFission\Connections\Database\MysqlLink;
// use BlueFission\Data\Storage\Mysql;
use App\Domain\User\Models\UserModel;
use BlueFission\Framework\Repository\RepositorySql;
use App\Domain\User\Repositories\IUserRepository;
use App\Domain\User\User;

class UserRepositorySql extends RepositorySql implements IUserRepository
{
    // protected $_db;
    protected $_name = "users";

    public function __construct(MysqlLink $link, UserModel $model)
    {
        parent::__construct($link, $model);
    }

    public function find($id)
    {
        $this->_model->id = $id;
        $this->_model->read();

        return $this->_model->response();
    }

    public function save(User $user)
    {
        $this->_db->assign($user);
        $this->_db->write();
    }

    public function remove($id)
    {
        $this->_db->id($id);
        $this->_db->delete();
    }
}