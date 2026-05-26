<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(
            Project::with('issues')->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'nullable|string'
        ]);

        $project = Project::create($validated);

        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        return response()->json(
            $project->load('issues')
        );
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
            'description' => 'nullable|string'
        ]);

        $project->update($validated);

        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'Project deleted'
        ]);
    }
}
