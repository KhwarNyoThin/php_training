<?php

namespace App\Http\Controllers\Task;

use App\Contracts\Services\Task\TaskServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TaskValidateRequest;

class TaskController extends Controller
{
    //task interface
    private $taskService;

    /**
     * TaskController Constructor
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display Task
     * @return array of task
     */
    public function displayTask() {
        $task = $this->taskService->displayTask();
        return view('tasks', [
            'tasks' => $task
        ]);
    }

    /**
     * To add new task
     * @param Request $request request to add new task
     * @return View home
     */
    public function addTask(TaskValidateRequest $request) {
        $validate = $request->validated();
        $task = $this->taskService->addTask($validate);
        return redirect('/');
    }

    /**
     * To delete task
     * @param string $id of Task
     * @return View Task List
     */
    public function deleteTask($id)
    {

        $delete = $this->taskService->deleteTask($id);
        return redirect('/');
    }
}
