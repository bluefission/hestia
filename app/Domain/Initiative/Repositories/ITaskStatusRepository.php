<?php
namespace App\Domain\Initiative\Repositories;

use App\Domain\Initiative\TaskStatus;
use App\Domain\Initiative\Models\TaskStatusModel;

interface ITaskStatusRepository
{
    public function find($id);
    public function save(TaskStatus $task_status);
    public function remove(TaskStatus $task_status);
}