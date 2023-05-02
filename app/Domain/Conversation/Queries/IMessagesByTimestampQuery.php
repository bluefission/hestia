<?php
namespace App\Domain\Conversation\Queries;


interface IMessagesByTimestampQuery
{
    public function fetch($timestamp, $limit);
}