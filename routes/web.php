<?php

use App\Models\Project;
use App\Models\Activity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/projects', [ProjectsController::class, 'index'])->name('dashboard');
    Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projectsCreate');
    Route::get('/projects/{project}', [ProjectsController::class, 'show']);
    Route::get('/projects/{project}/edit', [ProjectsController::class, 'edit']);

    Route::post('/projects', [ProjectsController::class, 'store']);
    Route::post('/projects/{project}/tasks', [ProjectsTaskController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectsTaskController::class, 'update']);
    Route::patch('/projects/{project}', [ProjectsController::class, 'update']);
});


require __DIR__.'/auth.php';
