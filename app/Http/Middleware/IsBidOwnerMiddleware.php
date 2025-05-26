<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsBidOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {        
        // get bid data
        $bid = $request->route('bid');

        // check if user is project owner
        if($bid && $bid->freelancer_id !== Auth::id()) return redirect()->route('projects.index');

        return $next($request);
    }
}
