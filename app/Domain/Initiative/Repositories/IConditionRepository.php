<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\Condition;
use App\Domain\Initiative\Models\ConditionModel;

interface IConditionRepository
{
    public function find($id);
    public function save(Condition $operator);
    public function remove(Condition $operator);
}