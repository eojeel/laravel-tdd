<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{

    public function index()
    {
        return view('projects.index', [
           'projects' => Project::all()
       ]);
    }

    public function store()
    {

        $project = auth()->user()->projects()->create($this->validatefields());

        if(request()->wantsJson())
        {
            return ['message' => $project->path()];
        }

        return redirect($project->path());
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validatefields());

        return redirect($project->path());
    }

    public function show(Project $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function destroy(Project $project)
    {
        $this->authorize('manage', $project);

        $project->delete();

        return redirect('/projects');
    }

    protected function validatefields()
    {
        return request()->validate([
            'title' => 'sometimes|required|max:255',
            'description' => 'sometimes|required|max:255',
            'notes' => 'nullable'
        ]);
    }
}
