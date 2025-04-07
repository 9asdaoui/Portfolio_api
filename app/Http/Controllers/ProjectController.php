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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            $project = new Project();
            $project->title = $request->title;
            $project->description = $request->description;
            $project->image_url = $request->image_url;
            $project->project_url = $request->project_url;
            $project->type = $request->type;
            $project->save();

            if ($request->has('tools')) {
                $project->tools()->attach($request->tools);
            }

            return redirect()->route('home')->with('success', 'Project created successfully');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Failed to create project: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            $project->title = $request->title;
            $project->description = $request->description;
            $project->image_url = $request->image_url;
            $project->project_url = $request->project_url;
            $project->type = $request->type;
            $project->save();

            if ($request->has('tools')) {
                $project->tools()->sync($request->tools);
            }

            return redirect()->route('home')->with('success', 'Project updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Failed to update project: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->tools()->detach();
            $project->delete();
            return redirect()->route('home')->with('success', 'Project deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Failed to delete project: ' . $e->getMessage());
        }
    }
}
