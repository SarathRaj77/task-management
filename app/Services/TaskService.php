<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Enums\TaskStatusEnum;
use App\Events\TaskCompleteEvent;
use App\Repositories\TaskRepository;
use App\Jobs\SendTaskAssignedNotification;

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

    public function expireOverdueTasks()
    {
        $now = Carbon::now();
        $this->model->where('due_date', '<', $now)
            ->where('status', TaskStatusEnum::PENDING)
            ->update(['status' => TaskStatusEnum::EXPIRED]);
    }
}
