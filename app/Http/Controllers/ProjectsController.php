<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
       Project::all();
    }

    public function store()
    {
        Project::create([
            'title' => request('title'),
            'description' => request('description')
        ]);

        return redirect('/projects');
    }
}
