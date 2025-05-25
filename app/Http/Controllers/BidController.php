<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bid;
use App\Models\Project;

class BidController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        // check if bid exists
        $existingBid = $project->bids()->where('freelancer_id', Auth::id())->first();
        if ($existingBid) return back()->with('error', 'You have already submitted a bid!');

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
            // create new project
            Bid::create($formData);

            // redirect user - with success msg
            return back()->with('success', 'Bid created successfully!');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error creating a bid for the project!');
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
    public function destroy(Bid $bid)
    {
        // check if selected bid status == pending
        if ($bid->status !== 'pending') return back()->with('error', 'Only pending bids can be deleted!');

        try {
            // delete from database
            $bid->delete();

            // redirect user - with success msg           
            return back()->with('success', 'Selected bid has been deleted.');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error deleting the bid!');
        }
    }
}
