<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource. - all client users
     */
    public function allClientUsers(): View
    {
        // get all client users
        $allClientUsers = User::where('account_type', 'client')
            ->with(['projects:id'])
            ->latest()
            ->paginate(12);

        $allClientUsers->each(function ($client) {            
            $client->client_avg_received_rate = Rating::where('client_id', $client->id)->avg('client_received_rate');
            $client->client_num_received_ratings = Rating::where('client_id', $client->id)->count('client_received_rate');
            $client->projects_count = $client->projects()->count();
        });
        
        // display/return view
        return view('adminUser.clients-list')->with('allClientUsers', $allClientUsers);
    }

    public function clientUser()
    {

    }
}
