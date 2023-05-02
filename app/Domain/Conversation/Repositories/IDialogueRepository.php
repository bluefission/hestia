<?php
namespace App\Domain\Conversation\Repositories;

use App\Domain\Conversation\Dialogue;
use App\Domain\Conversation\Models\DialogueModel;

interface IDialogueRepository
{
    public function find($id);
    public function search(Dialogue $dialogue);
    public function save(Dialogue $dialogue);
    public function remove(Dialogue $dialogue);
}