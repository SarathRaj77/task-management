<?php

namespace App\Services;

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
}
