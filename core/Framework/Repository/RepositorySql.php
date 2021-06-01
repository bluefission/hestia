<?php
namespace BlueFission\Framework\Repository;

// use BlueFission\Data\Storage\Mysql;
use BlueFission\Framework\Model\ModelSql as Model;
use BlueFission\Connections\Database\MysqlLink;

class RepositorySql extends BaseRepository
{
    public function __construct(MysqlLink $link, Model $model)
    {
        $link->open();
        parent::__construct($model);
    }
}