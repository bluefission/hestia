<?php
namespace BlueFission\Framework\Repository;

// use BlueFission\Data\Storage\Storage;
use BlueFission\Framework\Model\BaseModel;

class BaseRepository
{
    protected $_model;
    
    public function __construct(BaseModel $model)
    {
        $this->_model = $model;
    }
}