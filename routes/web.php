<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsTaskController;
use App\Http\Controllers\ProjectsInvitationController;

Route::get('/', [ProjectsController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/projects', [ProjectsController::class, 'index'])->name('dashboard');
    // Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projectsCreate');
    // Route::get('/projects/{project}', [ProjectsController::class, 'show']);
    // Route::get('/projects/{project}/edit', [ProjectsController::class, 'edit']);
    // Route::delete('/projects/{project}', [ProjectsController::class, 'destroy']);
    Route::resource('projects', ProjectsController::class);

    Route::post('/projects', [ProjectsController::class, 'store']);
    Route::post('/projects/{project}/tasks', [ProjectsTaskController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectsTaskController::class, 'update']);
    Route::patch('/projects/{project}', [ProjectsController::class, 'update']);

    Route::post('/projects/{project}/invitations', [ProjectsInvitationController::class, 'store']);
});


require __DIR__.'/auth.php';
