<?php
namespace App\Domain\Conversation\Queries;

interface IMessagesByKeywordQuery
{
    public function fetch($keywords, $limit);
}