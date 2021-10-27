<?php

namespace App\Http\Controllers\Task;

use App\Contracts\Services\Task\TaskServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TaskValidateRequest;

class TaskController extends Controller
{
    //task interface
    private $taskInterface;

    /**
     * TaskController Constructor
     */
    public function __construct(TaskServiceInterface $taskInterface)
    {
        $this->taskInterface = $taskInterface;
    }

    /**
     * Display Task
     * @return array of task
     */
    public function displayTask() {
        $task = $this->taskInterface->displayTask();
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
        $task = $this->taskInterface->addTask($validate);
        return redirect('/');
    }

    /**
     * To delete task
     * @param string $id of Task
     * @return View Task List
     */
    public function deleteTask($id)
    {

        $delete = $this->taskInterface->deleteTask($id);
        return redirect('/');
    }
}
