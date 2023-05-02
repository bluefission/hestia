<?php
namespace App\Domain\Conversation\Repositories;

use App\Domain\Conversation\Fact;
use App\Domain\Conversation\Models\FactModel;

interface IFactRepository
{
    public function find($id);
    public function save(Fact $fact);
    public function remove(Fact $fact);
}