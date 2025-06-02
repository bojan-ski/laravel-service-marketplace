<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Conversation;
use App\Models\Project;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $currUserId = Auth::id();

        $conversations = Conversation::where('client_id', $currUserId)
            ->orWhere('freelancer_id', $currUserId)
            ->with(['project:id,title', 'client:id,name', 'freelancer:id,name'])
            ->latest()
            ->paginate(1);

        $conversations->each(function ($conversation) use ($currUserId) {
            $conversation->other_participant = ($conversation->client_id == $currUserId) ? $conversation->freelancer_id : $conversation->client_id;
        });

        return view('conversations.index')->with('conversations', $conversations);
    }

    /**
     * Start/continue conversation
     */
    public function thread(Project $project, int $freelancerId): RedirectResponse
    {
        // check if existing conversation
        $conversation = Conversation::firstOrCreate([
            'project_id' => $project->id,
            'client_id' => Auth::id(),
            'freelancer_id' => $freelancerId,
        ]);

        // redirect user
        return redirect()->route('conversations.show', $conversation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        // is authorized
        if (!(Auth::id() == $conversation->client_id || Auth::id() == $conversation->freelancer_id)) {
            return redirect()->route('projects.index')->with('error', 'You are not authorized to view this conversation.');
        }

        // get all message related to the conversation
        // $messages = $conversation->messages()->with('sender')->get();
        $messages = $conversation->messages()->with('sender:id,name')->orderBy('created_at', 'asc')->get();

        // Fetch the associated project for context
        $project = $conversation->project;

        // get the other user
        $otherUserForChat = (Auth::id() === $conversation->client_id)
            ? $conversation->freelancer
            : $conversation->client;

         // display/return view
        return view('conversations.show')
            ->with('conversation', $conversation)
            ->with('messages', $messages)
            ->with('project', $project)
            ->with('currentUser', Auth::user())
            ->with('otherUserForChat', $otherUserForChat);
    }
}
