<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        return response()->json(
            Issue::with('project')->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|min:5|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $issue = Issue::create($validated);

        return response()->json($issue, 201);
    }

    public function show(Issue $issue)
    {
        return response()->json(
            $issue->load('project')
        );
    }

    public function update(Request $request, Issue $issue)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|min:5|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $issue->update($validated);

        return response()->json($issue);
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();

        return response()->json([
            'message' => 'Issue deleted'
        ]);
    }
}
