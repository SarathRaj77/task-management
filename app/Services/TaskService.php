<?php

namespace App\Services;

use App\Enums\TaskStatusEnum;
use App\Events\TaskCompleteEvent;
use App\Jobs\SendTaskAssignedNotification;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;

class TaskService extends TaskRepository
{

    public function assignTask(Task $task, User $user)
    {
        $task->update(['assigned_to' => $user->id]);
        SendTaskAssignedNotification::dispatch($task, $user);
    }

    public function completeTask(Task $task)
    {
        $task->update(['status' => TaskStatusEnum::COMPLETED]);
        TaskCompleteEvent::dispatch($task);
    }
}
