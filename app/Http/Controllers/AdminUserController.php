<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Project;
use App\Models\Rating;
use App\Models\User;
use App\Models\Bid;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource - all client users
     */
    public function allClientUsers(): View
    {
        // get all client users
        $allClientUsers = User::where('account_type', 'client')
            ->latest()
            ->paginate(12);

        $allClientUsers->each(function ($client) {
            $client->client_avg_received_rate = Rating::where('client_id', $client->id)->avg('client_received_rate');
            $client->client_num_received_ratings = Rating::where('client_id', $client->id)->count('client_received_rate');
            $client->projects_count = $client->projects()->count();
            $client->conversations_count = $client->clientConversations()->count();
        });

        // display/return view
        return view('adminUser.clients-list')->with('allClientUsers', $allClientUsers);
    }

    /**
     * Display the specified resource - selected client users
     */
    public function clientUser(User $client): View
    {
        // get client user projects
        $clientUserProjects = $client->projects;

        // get client user conversations
        $clientUserConversations = $client->clientConversations;

        // display/return view
        return view('adminUser.selected-client')
            ->with('client', $client)
            ->with('clientUserProjects', $clientUserProjects)
            ->with('clientUserConversations', $clientUserConversations);
    }

    /**
     * Display a listing of the resource - all freelancer users
     */
    public function allFreelancerUsers(): View
    {
        // get all freelancer users
        $allFreelancerUsers = User::where('account_type', 'freelancer')
            ->latest()
            ->paginate(12);

        $allFreelancerUsers->each(function ($freelancer) {
            $freelancer->user_avg_received_rate = Rating::where('freelancer_id', $freelancer->id)->avg('freelancer_received_rate');
            $freelancer->user_num_received_ratings = Rating::where('freelancer_id', $freelancer->id)->count('freelancer_received_rate');
            $freelancer->bids_count = $freelancer->submittedBids()->count();
            $freelancer->conversations_count = $freelancer->freelancerConversations()->count();
        });

        // display/return view
        return view('adminUser.freelancers-list')->with('allFreelancerUsers', $allFreelancerUsers);
    }

    /**
     * Display the specified resource - selected freelancer users
     */
    public function freelancerUser(User $freelancer): View
    {
        // get freelancer submitted bids
        $freelancerUserBids = $freelancer->submittedBids;

        // get freelancer user conversations
        $freelancerUserConversations = $freelancer->freelancerConversations;

        // display/return view
        return view('adminUser.selected-freelancer')
            ->with('freelancer', $freelancer)
            ->with('freelancerUserBids', $freelancerUserBids)
            ->with('freelancerUserConversations', $freelancerUserConversations);
    }

    /**
     * Delete app user account
     */
    public function deleteUser(User $user): RedirectResponse
    {
        try {
            // delete app user from db
            $user->delete();

            // redirect admin user with success msg
            return redirect()->route('admin.clients')->with('success', 'User account has been deleted');
        } catch (\Exception $e) {
            // redirect user with error msg
            return back()->with('error', 'There was an error deleting user account');
        }
    }

    /**
     * Display a listing of the resource - all projects
     */
    public function allProjects(): View
    {
        // get all projects
        $allProjects = Project::latest()->paginate(12);

        // display/return view
        return view('adminUser.projects-list')->with('allProjects', $allProjects);
    }

    /**
     * Apply select option - filter feature - projects
     */
    public function filterProjects(Request $request): View
    {
        // validate form data
        $formData = $request->validate([
            'filter_projects' => 'required|string|in:all,in_progress,completed,cancelled'
        ]);

        $projectStatus = $formData['filter_projects'];
        
        // check if form data == 'all'
        if ($projectStatus == 'all') return $this->allProjects();

        // get freelance user bids based on select option
        $allProjects = Project::where('status', $projectStatus)->latest()->paginate(12);

        // display/return view
        return view('adminUser.projects-list')->with('allProjects', $allProjects);
    }

    /**
     * Display a listing of the resource - all submitted bids
     */
    public function allBids(): View
    {
        // get all projects
        $allBids = Bid::latest()->paginate(12);

        // display/return view
        return view('adminUser.bids-list')->with('allBids', $allBids);
    }

    /**
     * Apply select option - filter feature - submitted bids
     */
    public function filterBids(Request $request): View
    {
        // validate form data
        $formData = $request->validate([
            'filter_bids' => 'required|string|in:all,pending,accepted,rejected'
        ]);

        $bidStatus = $formData['filter_bids'];
        
        // check if form data == 'all'
        if ($bidStatus == 'all') return $this->allBids();

        // get freelance user bids based on select option
        $allBids = Bid::where('status', $bidStatus)->latest()->paginate(12);

        // display/return view
        return view('adminUser.bids-list')->with('allBids', $allBids);
    }
}
