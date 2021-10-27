<?php

namespace App\Contracts\Services\Task;

use Illuminate\Http\Request;

/**
 * Interface of Service for Task
 */
interface TaskServiceInterface {

    /**
     * Display Task
     */
    public function displayTask();

    /**
     * To add new task
     * @param Request $request request to add new task
     * @return View home
     */
    public function AddTask($validate);

    /**
     * To delete task
     * @param string $id of Task
     * @return View Task List
     */
    public function deleteTask($id);

}