<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\Quantifier;
use App\Domain\Initiative\Models\QuantifierModel;

interface IQuantifierRepository
{
    public function find($id);
    public function save(Quantifier $quantifier);
    public function remove(Quantifier $quantifier);
}