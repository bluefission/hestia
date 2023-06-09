<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\Operator;
use App\Domain\Initiative\Models\OperatorModel;

interface IOperatorRepository
{
    public function find($id);
    public function save(Operator $operator);
    public function remove(Operator $operator);
}