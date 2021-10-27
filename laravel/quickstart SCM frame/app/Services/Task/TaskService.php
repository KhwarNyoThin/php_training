<?php

namespace App\Services\Task;

use App\Contracts\Dao\Task\TaskDaoInterface;
use App\Contracts\Services\Task\TaskServiceInterface;
use Illuminate\Http\Request;

class TaskService implements TaskServiceInterface {

    private $taskDao;

    /**
     * Class Constructor
     * @param TaskDaoInterface
     * @return
     */
    public function __construct(TaskDaoInterface $taskDao) {
        $this->taskDao = $taskDao;
    }
    

    /**
     * Display Task
     * @return array of task
     */
    public function displayTask() {
        return $this->taskDao->displayTask();
    }


    /**
     * To add new task
     * @param Request $request request to add new task
     * @return View home
     */
    public function addTask($validate) {
        return $this->taskDao->addTask($validate);
    }

    /**
     * To delete task
     * @param string $id of Task
     * @return View Task List
     */
    public function deleteTask($id) {
        return $this->taskDao->deleteTask($id);
    }
}