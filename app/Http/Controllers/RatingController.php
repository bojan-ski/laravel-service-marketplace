<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Project;
use App\Models\Rating;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $currUser = Auth::user();

        // get user received ratings
        $avgUserRate = $currUser->account_type == 'client' ? Rating::where('client_id', $currUser->id)->avg('client_received_rate') : Rating::where('freelancer_id', $currUser->id)->avg('freelancer_received_rate');
        $numOfReceivedRatings = $currUser->account_type == 'client' ? Rating::where('client_id', $currUser->id)->count('client_received_rate') : Rating::where('freelancer_id', $currUser->id)->count('freelancer_received_rate');

        // get user ratings
        $allUserRatings = Rating::where('client_id', $currUser->id)
            ->orWhere('freelancer_id', $currUser->id)
            ->with(['project:id,title', 'client:id,name', 'freelancer:id,name'])
            ->latest()
            ->paginate(12);

        // display/return view
        return view('ratings.index')
            ->with('avgUserRate', $avgUserRate)
            ->with('numOfReceivedRatings', $numOfReceivedRatings)
            ->with('allUserRatings', $allUserRatings);
    }

    /**
     * Update/accept the specified resource in storage. 
     */
    public function rateUser(Request $request, Project $project)
    {
        // validate form data
        $formData = $request->validate([
            'rating' => 'required|integer|in:1,2,3,4,5',
        ]);

        // get or create ratings
        $selectedRatings = Rating::firstOrCreate([
            'project_id' => $project->id,
            'client_id' => $project->user_id,
            'freelancer_id' => $project->acceptedBid->freelancer_id,
        ]);

        // get user and apply rate
        $user = Auth::id() == $selectedRatings->client_id ? 'freelancer_received_rate' : 'client_received_rate';
        $userRate = [
            $user => $formData['rating']
        ];

        try {
            // update ratings
            $selectedRatings->update($userRate);

            // redirect user - with success msg
            return back()->with('success', 'User rated');
        } catch (\Exception $e) {
            // redirect user - with error msg
            return back()->with('error', 'There was an error rating the user');
        }
    }
}
