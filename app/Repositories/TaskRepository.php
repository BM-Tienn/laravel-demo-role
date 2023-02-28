<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function save($data)
    {
        $task = new $this->task;
        $task->name = $data['name'];
        $task->save();

        return $task->fresh();
    }

    public function getAllTask()
    {
        return $this->task->get();
    }

    public function update($data, $id)
    {
        $task = $this->task->find($id);
        $task->name = $data['name'];
        $task->update();

        return $task;
    }

    public function delete($id)
    {
        $task = $this->task->find($id);
        $task->delete();
        return $task;
    }
}