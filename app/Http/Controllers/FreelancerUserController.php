<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bid;

class FreelancerUserController extends Controller
{
    /**
     * Display freelance user bids
     */
    public function freelancerBids()
    {
        // get freelance user bids
        $freelanceBids = Bid::latest()->where('freelancer_id', Auth::id())->paginate(12);

        // display/return view
        return view('freelancerUser.freelancer-bids')->with('freelanceBids', $freelanceBids);
    }
}
