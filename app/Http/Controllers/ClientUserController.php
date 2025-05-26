<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientUserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Display client user open projects
     */
    public function clientOpenProjects(): View
    {
        // call User modal method (openProjects) -> get all client user open projects
        $projects = $this->user->openProjects()->latest()->paginate(1);

        // display/return view
        return view('clientUser.client-open-projects')->with('projects', $projects);
    }

    /**
     * Display client user in progress projects
     */
    public function clientInProgressProjects(): View
    {
        // call User modal method (inProgressProjects) -> get all client user in progress projects
        $projects = $this->user->inProgressProjects()->latest()->paginate(1);

        // display/return view
        return view('clientUser.client-in-progress-projects')->with('projects', $projects);
    }

    /**
     * Display client user completed projects
     */
    public function clientCompletedProjects(): View
    {
        // call User modal method (completedProjects) -> get all client user completed projects
        $projects = $this->user->completedProjects()->latest()->paginate(1);

        // display/return view
        return view('clientUser.client-completed-projects')->with('projects', $projects);
    }

    /**
     * Display client user cancelled projects
     */
    public function clientCancelledProjects(): View
    {
        // call User modal method (cancelledProjects) -> get all client cancelledProjects projects
        $projects = $this->user->cancelledProjects()->latest()->paginate(1);

        // display/return view
        return view('clientUser.client-cancelled-projects')->with('projects', $projects);
    }
}
