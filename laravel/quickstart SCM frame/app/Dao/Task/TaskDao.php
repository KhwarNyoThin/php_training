<?php

namespace App\Dao\Task;

use App\Models\Task;
use App\Contracts\Dao\Task\TaskDaoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

Class TaskDao implements TaskDaoInterface {

    /**
     * Display Task
     */
    function displayTask() {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return $tasks;
    }

    /**
     * Add New Task
     */
    function addTask($validate) {
    
        $task = new Task;
        $task->name = $validate['name'];
        $task->save();
    
        return redirect('/');
    }

    /**
     * Delete Existing Task
     */
    function deleteTask($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    }
}