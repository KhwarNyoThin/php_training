<?php

use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;
/**
 * Display All Tasks
 */
Route::get('/', [TaskController::class, 'displayTask']);


/**
 * Add A New Task
 */

Route::post('/task', [TaskController::class, 'addTask']);

/**
 * Delete An Existing Task
 */
Route::delete('/task/{id}', [TaskController::class, 'deleteTask']);