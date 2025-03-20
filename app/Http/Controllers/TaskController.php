<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\TaskDto;
use App\Filters\AssingnedUserFilter;
use App\Filters\OrderFilter;
use App\Filters\TaskStatusFilter;
use App\Http\Requests\AssignTaskRequest;
use App\Http\Requests\GetTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $task_service,
        protected UserService $user_service
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(GetTaskRequest $request)
    {
        $task_collection = $this->task_service->list([
            TaskStatusFilter::class,
            AssingnedUserFilter::class,
            OrderFilter::class
        ])->paginate(24);

        return  new TaskCollection($task_collection);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $dto = TaskDto::build($request->validated());
        $task = $this->task_service->create($dto);
        return $this->success('Task created successfully', new TaskResource($task));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * assign task to user.
     */
    public function assign(AssignTaskRequest $request, $id)
    {
        $task = $this->task_service->find($id);
        if ($task->assignedUser)
            return $this->error('Task already assigned');

        $user = $this->user_service->find($request->user_id);
        $this->task_service->assignTask($task, $user);
        return $this->success('Task assigned and notification sent!');
    }

    public function complete(int $id)
    {
        $task = $this->task_service->find($id);
        $this->task_service->completeTask($task);
        return $this->success('Task status changed to completed!');
    }
}
