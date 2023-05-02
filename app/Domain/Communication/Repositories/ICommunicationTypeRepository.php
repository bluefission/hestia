<?php
namespace App\Domain\Communication\Repositories;

use App\Domain\Communication\CommunicationType;

interface ICommunicationTypeRepository
{
    public function find($id);
    public function findByName($name);
    public function save(CommunicationType $communication_type);
    public function remove($id);
}