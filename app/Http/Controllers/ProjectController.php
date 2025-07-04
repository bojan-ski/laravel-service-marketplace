<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OpenProjectRequest;
use App\Models\Project;
use App\Models\Rating;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
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
        // get all submitted bids and freelancer received ratings, related to the selected project
        $submittedBids = $project->bids()->with('freelancer')->get();
        $submittedBids->each(function ($bid) {            
            $bid->freelancer_avg_received_rate = Rating::where('freelancer_id', $bid->freelancer_id)->avg('freelancer_received_rate');
            $bid->freelancer_num_received_ratings = Rating::where('freelancer_id', $bid->freelancer_id)->count('freelancer_received_rate');
        });

        // get client received ratings
        $averageClientRate = Rating::where('client_id', $project->user_id)->avg('client_received_rate');
        $clientNumberOfReceivedRatings = Rating::where('client_id', $project->user_id)->count('client_received_rate');

        // get the accepted bid & freelancer data related to the selected project
        $acceptedBidData = $project->acceptedBid;
        $freelancerData = $acceptedBidData ? $acceptedBidData->freelancer : '';
        $averageFreelancerRate = $acceptedBidData ? Rating::where('freelancer_id', $acceptedBidData->freelancer->id)->avg('freelancer_received_rate') : '';
        $numberOfReceivedRatings = $acceptedBidData ? Rating::where('freelancer_id', $acceptedBidData->freelancer->id)->count('freelancer_received_rate') : '';

        // display/return view
        return view('projects.show')
            ->with('project', $project)
            ->with('averageClientRate', $averageClientRate)
            ->with('clientNumberOfReceivedRatings', $clientNumberOfReceivedRatings)            
            ->with('acceptedBidData', $acceptedBidData)
            ->with('freelancerData', $freelancerData)
            ->with('averageFreelancerRate', $averageFreelancerRate)
            ->with('numberOfReceivedRatings', $numberOfReceivedRatings)
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
    
    /**
     * Move project status to completed or cancelled
     */
    public function statusChange(Project $project, string $status): RedirectResponse
    {
        try {
            // change project status
            $project->update(['status' => $status]);
            $flashMsgColor = $status == 'completed' ? 'success' : 'error';

            // redirect user - with error msg
            return back()->with($flashMsgColor, 'Project status: ' . strtoupper($status));
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error changing the status of the project');
        }
    }
}
