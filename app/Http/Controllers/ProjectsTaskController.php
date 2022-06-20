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
        $task->update($request->validated());

        return redirect($project->path());
    }
}
