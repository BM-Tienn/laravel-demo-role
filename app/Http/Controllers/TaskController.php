<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    // public function __construct(TaskService $taskService)
    // {
    //     $this->taskService = $taskService;
    // }
    public function index()
    {
        // try {
        //     $tasks['data'] = $taskService->getAll();
        // } catch (Exception $e) {
        //     $result = [
        //         'error' => $e->getMessage()
        //     ];
        // }
        $tasks = Task::all();
 
        return view('tasks.index', compact('tasks'));
    }
 
    public function create()
    {
        return view('tasks.create');
    }
 
    public function store(Request $request,TaskService $taskService)
    {
        $data = $request->only([
            'name',
        ]);

        try {
            $result['data'] = $taskService->saveTaskData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return redirect()->route('tasks.index')->with('success','Thêm mới thành công');
    }
 
    public function edit($id)
    {
        $task = Task::where('id',$id)->first();
        return view('tasks.edit', compact('task'));
    }
 
    public function update(Request $request, $id, TaskService $taskService)
    {
        $data = $request->only([
            'name',
        ]);

        try {
            $result['data'] = $taskService->updateTask($data, $id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return redirect()->route('tasks.index')->with('success','Sửa thành công');
    }
 
    public function destroy($id, TaskService $taskService)
    {
        try {
            $result['data'] = $taskService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()->with('success','Xóa thành công');
    }
}
