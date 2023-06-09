<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\InitiativeSpan;
use App\Domain\Initiative\Models\InitiativeSpanModel;

interface IInitiativeSpanRepository
{
    public function find($id);
    public function save(InitiativeSpan $initiative_span);
    public function remove(InitiativeSpan $initiative_span);
}