<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::with('project')->latest()->get();

        return Inertia::render('Issues/Index', [
            'issues' => $issues,
        ]);
    }

    public function create()
    {
        return Inertia::render('Issues/Create', [
            'projects' => Project::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|min:2|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,closed',
        ]);

        Issue::create($validated);

        return redirect()->route('issues.index')->with('message', 'Issue created!');
    }

    public function edit(Issue $issue)
    {
        return Inertia::render('Issues/Edit', [
            'issue' => $issue,
            'projects' => Project::all(),
        ]);
    }

    public function update(Request $request, Issue $issue)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|min:2|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $issue->update($validated);

        return redirect()->route('issues.index')->with('message', 'Issue updated!');
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();
        return redirect()->route('issues.index')->with('message', 'Issue deleted!');
    }
}
