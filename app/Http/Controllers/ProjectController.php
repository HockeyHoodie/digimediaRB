<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use App\Models\Issue;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return Inertia::render('Projects/Index',compact('projects'));
    }

    public function create()
    {
        return Inertia::render('Projects/Create', []);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'nullable|string'
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('message', 'Project created!');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $project->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('projects.index')->with('message', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('message', 'Project deleted!');
    }

    public function dashboard()
    {
        $projects = Project::latest()->get();

    return Inertia::render('Dashboard', [
        'projects' => $projects,
    ]);
    }

    public function issues(Project $project)
    {
        $project->load('issues');

        return Inertia::render('Projects/Issues', [
            'project' => $project,
            'breadcrumbs' => [
                [
                    'title' => 'Projects',
                    'href' => route('projects.index'),
                ],
                [
                    'title' => "Issues for: {$project->title}",
                    'href' => route('projects.issues', $project),
                ],
            ],
        ]);
    }
}
