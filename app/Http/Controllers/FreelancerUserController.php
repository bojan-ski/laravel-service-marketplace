<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Project;

class FreelancerUserController extends Controller
{
    /**
     * Display freelance user bids
     */
    public function freelancerBids(): View
    {
        // get freelance user bids
        $freelanceBids = Auth::user()->submittedBids()->latest()->paginate(12);

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
            ->paginate(1);

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

        // check if form data == 'all'
        $projectStatus = $formData['freelancer_projects'];

        if ($projectStatus == 'all') return $this->freelancerWonProjects();

        // get won projects based on select option
        $projects = Project::whereHas('bids', function (Builder $query) {
            $query->where('freelancer_id', Auth::id())
                ->where('status', 'accepted');
        })
            ->where('status', $projectStatus)
            ->latest()
            ->paginate(1);

        // display/return view
        return view('freelancerUser.freelancer-won-projects')->with('projects', $projects);
    }
}
