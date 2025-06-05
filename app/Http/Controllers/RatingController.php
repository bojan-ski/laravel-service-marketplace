<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Rating;

class RatingController extends Controller
{
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
        $user = Auth::id() == $selectedRatings->client_id ? 'client_received_rate' : 'freelancer_received_rate';
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
