<?php
namespace BlueFission\Framework\Repository;

use BlueFission\Framework\Model\ModelSession as Model;

class RepositorySession extends BaseRepository
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}