<?php
namespace App\Domain\Conversation\Queries;

interface IMessagesQuery
{
    public function fetchRecent($limit);
}