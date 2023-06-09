<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\UnitType;
use App\Domain\Initiative\Models\UnitTypeModel;

interface IUnitTypeRepository
{
    public function find($id);
    public function save(UnitType $unit_type);
    public function remove(UnitType $unit_type);
}