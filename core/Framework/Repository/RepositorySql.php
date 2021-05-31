<?php
namespace BlueFission\Framework\Repository;

// use BlueFission\Data\Storage\Mysql;
use BlueFission\Framework\Model\ModelSql;
use BlueFission\Connections\Database\MysqlLink;

class RepositorySql extends BaseRepository
{
    public function __construct(MysqlLink $link, ModelSql $model)
    {
        $link->open();
        parent::__construct($model);
    }
}