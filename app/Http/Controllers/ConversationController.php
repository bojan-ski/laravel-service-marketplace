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
        // get user conversations
        $currUserId = Auth::id();

        $conversations = Conversation::where('client_id', $currUserId)
            ->orWhere('freelancer_id', $currUserId)
            ->withCount(['messages as unread_count' => function ($q) use ($currUserId) {
                $q->where('sender_id', '!=', $currUserId)
                    ->whereNull('read_at');
            }])
            ->with(['project:id,title,deadline,status', 'client:id,name', 'freelancer:id,name'])
            ->latest()
            ->paginate(12);

        // display/return view
        return view('conversations.index')->with('conversations', $conversations);
    }

    /**
     * Start/continue conversation
     */
    public function thread(Project $project): RedirectResponse
    {
        // check if existing conversation
        $conversation = Conversation::firstOrCreate([
            'project_id' => $project->id,
            'client_id' => $project->user_id,
            'freelancer_id' => $project->acceptedBid->freelancer_id,
        ]);

        // redirect user
        return redirect()->route('conversations.show', $conversation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation): View
    {
        // get all message related to the conversation
        $messages = $conversation->messages()->orderBy('created_at', 'asc')->get();

        // mark received messages as read
        $messages->each(function ($message) {
            if ($message->sender_id != Auth::id() && is_null($message->read_at)) {
                $message->markAsRead();
            }
        });

        // display/return view
        return view('conversations.show')
            ->with('conversation', $conversation)
            ->with('messages', $messages);
    }
}
