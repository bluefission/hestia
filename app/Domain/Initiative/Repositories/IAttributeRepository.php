<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\Attribute;
use App\Domain\Initiative\Models\AttributeModel;

interface IAttributeRepository
{
    public function find($id);
    public function save(Attribute $attribute);
    public function remove(Attribute $attribute);
}