<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OpenProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all open projects
        $openProjects = Project::latest()->where('status', 'open')->paginate(12);

        // display/return view
        return view('projects.index')->with('openProjects', $openProjects);
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
    public function store(OpenProjectRequest $request): RedirectResponse
    {
        // validate form data
        $formData = $request->validated();

        // if document is uploaded
        if ($request->hasFile('document_path')) {
            $docPath = $request->file('document_path')->store('documents', 'public');

            $formData['document_path'] = $docPath;
        }

        try {
            // create new project
            Project::create($formData);

            // redirect user - with success msg
            return redirect()->route('projects.index')->with('success', 'Project posted successfully');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error posting the new project');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        // get all submitted bids related to the selected project
        $submittedBids = $project->bids;

        // get the accepted bid & freelancer related to the selected project
        $acceptedBidData = $project->acceptedBid;
        $freelancerData = $acceptedBidData ? $acceptedBidData->freelancer : '';

        // display/return view
        return view('projects.show')
            ->with('project', $project)
            ->with('acceptedBidData', $acceptedBidData)
            ->with('freelancerData', $freelancerData)
            ->with('submittedBids', $submittedBids);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        return view('projects.edit')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OpenProjectRequest $request, Project $project): RedirectResponse
    {
        // validate form data
        $formData = $request->validated();

        try {
            // update project
            $project->update($formData);

            // redirect user - with success msg
            $segments = request()->segments();

            return redirect($segments[0] . '/' . $segments[1])->with('success', 'Project updated successfully');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error updating the project');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        // check if selected project status == open
        if ($project->status !== 'open') return back()->with('error', 'Only open projects can be deleted');

        try {
            // if document delete, document from storage
            if ($project->document_path) {
                Storage::disk('public')->delete($project->document_path);
            }

            // delete from database
            $project->delete();

            // redirect user - with success msg           
            return redirect()->route('projects.index')->with('success', 'Selected open project deleted');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error deleting the project');
        }
    }
}
