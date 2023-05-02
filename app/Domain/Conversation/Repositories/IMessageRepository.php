<?php
namespace App\Domain\Conversation\Repositories;

use App\Domain\Conversation\Message;
use App\Domain\Conversation\Models\MessageModel;

interface IMessageRepository
{
    public function find($id);
    public function save(Message $message);
    public function remove(Message $message);
}