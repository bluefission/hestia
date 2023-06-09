<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\InitiativeStatus;
use App\Domain\Initiative\Models\InitiativeStatusModel;

interface IInitiativeStatusRepository
{
    public function find($id);
    public function save(InitiativeStatus $initiative_status);
    public function remove(InitiativeStatus $initiative_status);
}