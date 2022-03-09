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
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        auth()->user()->projects()->create($attributes);

        return redirect('/projects');
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
}
