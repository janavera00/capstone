<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class FilingController extends Controller
{
    public function show()
    {
        $projects = Project::all();

        // dd($projects);

        return view('filing', ['projects' => $projects]);
    }

    public function showFiles($project_id)
    {
        $project = Project::find($project_id);

        // dd($project->files);

        return view('file', ['project' => $project]);
    }
}
