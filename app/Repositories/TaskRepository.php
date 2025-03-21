<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Task());
    }
}
