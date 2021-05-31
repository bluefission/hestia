<?php
namespace BlueFission\Framework\Repository;

// use BlueFission\Data\Storage\Storage;
use BlueFission\Framework\Model\BaseModel;

class BaseRepository
{
    protected $_model;
    // protected $_db;
    // protected $_name = '';
    // protected $_location = '';

    // public function __construct(Storage $db)
    // {
    //     $this->_db = $db;
    //     $this->_db->config('name', $this->_name);
    //     $this->_db->config('location', $this->_location);
    //     $this->_db->activate();
    // }

    public function __construct(BaseModel $model)
    {
        $this->_model = $model;
    }
}