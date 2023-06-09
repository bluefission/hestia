<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\Initiative;
use App\Domain\Initiative\Models\InitiativeModel;

interface IInitiativeRepository
{
    public function find($id);
    public function save(Initiative $initiative);
    public function remove(Initiative $initiative);
}