<?php
namespace App\Domain\Communication\Repositories;

use App\Domain\Communication\Communication;

interface ICommunicationRepository
{
    public function find($id);
    public function save(Communication $communication, array $attributes = [], array $parameters = []);
    public function remove($id);
}