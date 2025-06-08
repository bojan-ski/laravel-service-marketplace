<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;

class FreelancerUserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display freelance user bids
     */
    public function freelancerBids(): View
    {
        // get freelance user bids
        $freelanceBids = $this->user->submittedBids()->latest()->paginate(12);

        // display/return view
        return view('freelancerUser.freelancer-bids')->with('freelanceBids', $freelanceBids);
    }

    /**
     * Apply select option - filter feature
     */
    public function applySelectOptionBids(Request $request): View
    {
        // validate form data
        $formData = $request->validate([
            'freelancer_bids' => 'required|string|in:all,pending,accepted,rejected'
        ]);

        $bidStatus = $formData['freelancer_bids'];
        
        // check if form data == 'all'
        if ($bidStatus == 'all') return $this->freelancerBids();

        // get freelance user bids based on select option
        $freelanceBids = $this->user->submittedBids()->where('status', $bidStatus)->latest()->paginate(12);

        // display/return view
        return view('freelancerUser.freelancer-bids')->with('freelanceBids', $freelanceBids);
    }

    /**
     * Display freelance user won projects
     */
    public function freelancerWonProjects(): View
    {
        // get won projects
        $projects = Project::whereHas('bids', function (Builder $query) {
            $query->where('freelancer_id', Auth::id())
                ->where('status', 'accepted');
        })
            ->latest()
            ->paginate(12);

        // display/return view
        return view('freelancerUser.freelancer-won-projects')->with('projects', $projects);
    }

    /**
     * Apply select option for the won projects
     */
    public function applySelectOptionWonProjects(Request $request): View
    {
        // validate form data
        $formData = $request->validate([
            'freelancer_projects' => 'required|string|in:all,in_progress,completed,cancelled'
        ]);

        $projectStatus = $formData['freelancer_projects'];
        
        // check if form data == 'all'
        if ($projectStatus == 'all') return $this->freelancerWonProjects();

        // get won projects based on select option
        $projects = Project::whereHas('bids', function (Builder $query) {
            $query->where('freelancer_id', Auth::id())
                ->where('status', 'accepted');
        })
            ->where('status', $projectStatus)
            ->latest()
            ->paginate(12);

        // display/return view
        return view('freelancerUser.freelancer-won-projects')->with('projects', $projects);
    }
}
