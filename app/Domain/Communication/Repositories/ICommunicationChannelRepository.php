<?php
namespace App\Domain\Communication\Repositories;

use App\Domain\Communication\CommunicationChannel;

interface ICommunicationChannelRepository
{
    public function find($id);
    public function findByName($name);
    public function save(CommunicationChannel $communication_channel);
    public function remove($id);
}