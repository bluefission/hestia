<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\Prerequisite;
use App\Domain\Initiative\Models\PrerequisiteModel;

interface IPrerequisiteRepository
{
    public function find($id);
    public function save(Prerequisite $prerequisite);
    public function remove(Prerequisite $prerequisite);
}