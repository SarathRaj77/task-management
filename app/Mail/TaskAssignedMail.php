<?php

namespace App\Mail;

use App\Models\Task;
use App\Models\User;
use Illuminate\Mail\Mailable;

class TaskAssignedMail extends Mailable
{
    public $task;
    public $user;

    public function __construct(Task $task, User $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('New Task Assigned')
            ->view('emails.task_assigned')
            ->with([
                'userName' => $this->user->name,
                'taskTitle' => $this->task->title,
                'taskDescription' => $this->task->description,
                'taskDueDate' => $this->task->due_date,
            ]);
    }
}
