<?php

use Illuminate\Support\Facades\Route;
use Tappx\Tasks\TasksManager\Infrastructure\Http\Api\GetTaskListController;

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
    }
);
