<?php
namespace App\Domain\Conversation\Repositories;

use App\Domain\Conversation\Topic;
use App\Domain\Conversation\Models\TopicModel;

interface ITopicRepository
{
    public function find($id);
    public function findByName($name);
    public function findByLabel($label);
    public function save(Topic $topic);
    public function remove(Topic $topic);
}