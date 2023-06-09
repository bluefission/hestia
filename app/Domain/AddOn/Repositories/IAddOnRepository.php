<?php
namespace App\Domain\AddOn\Repositories;

use App\Domain\AddOn\AddOn;

interface IAddOnRepository
{
    public function find($id);
    public function save(AddOn $addon);
    public function remove($id);
}