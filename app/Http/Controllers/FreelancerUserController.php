<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class FreelancerUserController extends Controller
{
    /**
     * Display freelance user bids
     */
    public function freelancerBids()
    {
        // get freelance user bids
        $freelanceBids = Auth::user()->submittedBids()->latest()->paginate(12);

        // display/return view
        return view('freelancerUser.freelancer-bids')->with('freelanceBids', $freelanceBids);
    }
}
