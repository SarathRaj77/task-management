<?php

namespace App\Providers;

use App\Events\TaskCompleteEvent;
use App\Listeners\TaskCompleteListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TaskCompleteEvent::class => [
            TaskCompleteListener::class,
        ],
    ];
}
