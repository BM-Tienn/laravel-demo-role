<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskService
{
    protected $taskRepository;
    protected $storeTaskRequest;
    protected $updateTaskRequest;

    public function __construct(TaskRepository $taskRepository, StoreTaskRequest $storeTaskRequest, UpdateTaskRequest $updateTaskRequest)
    {
        $this->taskRepository = $taskRepository;
        $this->storeTaskRequest = $storeTaskRequest;
        $this->updateTaskRequest = $updateTaskRequest;
    }

    public function saveTaskData($data )
    {
        
        $validator = Validator::make($data , $this->storeTaskRequest->rules());

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->taskRepository->save($data);
        return $result;
    }

    public function getAll()
    {
        return $this->taskRepository->getAllTask();
    }

    public function updateTask($data, $id)
    {
        
        $validator = Validator::make($data , $this->updateTaskRequest->rules());

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();
        try {
            $task = $this->taskRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update task data');
        }
        
        DB::commit();
        return $task;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $task = $this->taskRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete task data');
        }
        
        DB::commit();
        return $task;
    }
}