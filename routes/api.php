<?php

use Illuminate\Support\Facades\Route;
use Tappx\Tasks\TasksManager\Infrastructure\Http\Api\GetTaskController;
use Tappx\Tasks\TasksManager\Infrastructure\Http\Api\GetTaskListController;
use Tappx\Tasks\TasksManager\Infrastructure\Http\Api\SaveTaskController;
use Tappx\Tasks\TasksManager\Infrastructure\Http\Api\UpdateTaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    ['prefix' => 'tasks'],
    static function (): void {
        Route::get(
            '/',
            [GetTaskListController::class, 'execute']
        )->name('api.tasks.get');
        Route::post(
            '/',
            [SaveTaskController::class, 'execute']
        )->name('api.tasks.save');
        Route::get(
            '/{taskId}',
            [GetTaskController::class, 'execute']
        )->name('api.tasks.getById');
        Route::put(
            '/{taskId}',
            [UpdateTaskController::class, 'execute']
        )->name('api.tasks.update');
    }
);
