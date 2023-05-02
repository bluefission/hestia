<?php
namespace App\Domain\Conversation\Queries;

interface IMessagesByUserIdQuery
{
    public function fetch($userId, $limit);
}