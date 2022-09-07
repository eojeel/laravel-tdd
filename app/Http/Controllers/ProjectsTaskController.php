<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Http\Requests\UpdateProjectRequest;

class ProjectsTaskController extends Controller
{

    public function store(Project $project)
    {
        $this->authorize('update', $project);

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(UpdateProjectRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', $task->project);

        $task->update($request->validated());

        request('completed') ? $task->complete() : $task->incomplete();

        return redirect($project->path());
    }
}
