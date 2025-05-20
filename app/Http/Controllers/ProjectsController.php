<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Project;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form data
        $formData = $request->validate([
            'title' => 'required|string|max:64',
            'description' => 'required|string|max:5000',
            'requirements' => 'required|string|max:3000',
            'budget_type' => 'required|string|in:fixed,hourly',
            'budget_amount' => 'nullable|numeric|min:0',
            'hour_price' => 'nullable|numeric|min:0',
            'deadline' => 'required|string',
            'document_path' => 'nullable|file|mimes:pdf,doc,docx|max:1024'
        ]);

        // if document is uploaded
        if ($request->hasFile('document_path')) {
            $docPath = $request->file('document_path')->store('documents', 'public');

            $formData['document_path'] = $docPath;
        }

       // get user id
        $formData['user_id'] = Auth::id();

        try {
            // create new project
            Project::create($formData);

            // redirect user - with success msg
            return redirect()->route('dashboard')->with('success', 'Project posted successfully!');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error posting the new project!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
