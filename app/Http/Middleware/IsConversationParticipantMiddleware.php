<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsConversationParticipantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get conversation data
        $conversation = $request->route('conversation');

        // check if user is participant of the conversation owner
        if ($conversation && ($conversation->client_id == Auth::id() || $conversation->freelancer_id == Auth::id())) {
            return $next($request);
        }

        return redirect()->route('projects.index');
    }
}
