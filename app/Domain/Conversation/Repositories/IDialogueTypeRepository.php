<?php
namespace App\Domain\Conversation\Repositories;

use App\Domain\Conversation\DialogueType;
use App\Domain\Conversation\Models\DialogueTypeModel;

interface IDialogueTypeRepository
{
    public function find($id);
    public function findByName($name);
    public function save(DialogueType $dialogue_type);
    public function remove(DialogueType $dialogue_type);
}