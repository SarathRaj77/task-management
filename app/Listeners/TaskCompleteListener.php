<?php

namespace App\Listeners;

use Illuminate\Bus\Queueable;
use App\Events\TaskCompleteEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskCompleteListener implements ShouldQueue
{
    use InteractsWithQueue, Queueable;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCompleteEvent $event): void
    {
        Log::info("Task ID: {$event->task->id}, Title: {$event->task->title} has been marked as completed.");
    }
}
