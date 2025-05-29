<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Bid;
use App\Models\Project;

class BidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        // check if deadline reached
        $deadline = Carbon::parse($project->deadline);
        $currDate = Carbon::now();
        if ($currDate->isAfter($deadline)) return back()->with('error', 'Deadline reached');

        // check if bid exists
        $existingBid = $project->bids()->where('freelancer_id', Auth::id())->first();
        if ($existingBid) return back()->with('error', 'You have already submitted a bid');

        // validate form data
        $formData = $request->validate([
            'bid_amount' => 'required|numeric',
            'estimated_days' => 'required|integer|min:1',
            'bid_message' => 'required|string|max:500',
        ]);

        // set project_id, freelancer_id & budget_type
        $formData['project_id'] = $project->id;
        $formData['freelancer_id'] = Auth::id();
        $formData['budget_type'] = $project->budget_type;

        try {
            // create new bid
            Bid::create($formData);

            // redirect user - with success msg
            return back()->with('success', 'Bid created successfully');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error creating a bid for the project');
        }
    }

    /**
     * Update/accept the specified resource in storage. 
     */
    public function accept(Project $project, Bid $bid)
    {
        try {
            // update/accept bid & update/reject all other bids
            $bid->acceptBid();

            // update project
            $project->update(['status' => 'in_progress']);

            // redirect user - with error msg
            return back()->with('success', 'Bid accepted, project status updated: In progress');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error accepting the bid');
        }        
    }

    /**
     * Update/reject the specified resource in storage.
     */
    public function reject(Project $project, Bid $bid)
    {
        try {
            // update/reject bid
            $bid->rejectBid();

            // redirect user - with error msg
            return back()->with('success', 'Bid rejected');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error rejecting the bid');
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bid $bid)
    {
        try {
            // delete from database
            $bid->delete();

            // redirect user - with success msg           
            return back()->with('success', 'Selected bid has been deleted');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error deleting the bid');
        }
    }
}
