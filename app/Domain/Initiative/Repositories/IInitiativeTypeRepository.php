<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\InitiativeType;
use App\Domain\Initiative\Models\InitiativeTypeModel;

interface IInitiativeTypeRepository
{
    public function find($id);
    public function save(InitiativeType $initiative_type);
    public function remove(InitiativeType $initiative_type);
}