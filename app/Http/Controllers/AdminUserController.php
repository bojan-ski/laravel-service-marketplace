<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Rating;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource - all client users
     */
    public function allClientUsers(): View
    {
        // get all client users
        $allClientUsers = User::where('account_type', 'client')
            ->with(['projects:id', 'clientConversations:id'])
            ->latest()
            ->paginate(12);

        $allClientUsers->each(function ($client) {
            $client->client_avg_received_rate = Rating::where('client_id', $client->id)->avg('client_received_rate');
            $client->client_num_received_ratings = Rating::where('client_id', $client->id)->count('client_received_rate');
            $client->projects_count = $client->projects()->count();
            $client->conversations_count = $client->Conversations()->count();
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
}
