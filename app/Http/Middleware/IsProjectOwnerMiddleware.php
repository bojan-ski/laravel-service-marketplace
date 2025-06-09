<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsProjectOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get project data
        $project = $request->route('project');

        // check if user is project owner
        if($project && ($project->user_id == Auth::id() || Auth::user()->account_type == 'admin')) return $next($request);

        return redirect()->route('home');        
    }
}
