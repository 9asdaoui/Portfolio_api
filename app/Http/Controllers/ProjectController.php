<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        $projects->load('tools');
        return response()->json($projects);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('tools');
        return response()->json($project);
    }
}
