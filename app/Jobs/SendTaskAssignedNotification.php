<?php

namespace App\Jobs;

use App\Models\Task;
use App\Mail\TaskAssignedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTaskAssignedNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $task;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct(Task $task, User $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user?->email)->send(new TaskAssignedMail($this->task, $this->user));
    }
}
