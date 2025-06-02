<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Events\NewMessageEvent;
use App\Events\MessageDeletedEvent;
use App\Models\Conversation;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage - new message
     */
    public function store(Request $request, Conversation $conversation): JsonResponse|RedirectResponse
    {       
        // validate form data
        $request->validate([
            'message' => 'required|string|max:100',
        ]);

        try {
            // submit message
            $message = Message::create([
                'chat_hash' => $conversation->chat_hash,
                'sender_id' => Auth::id(),
                'message' => $request->message,
            ]);

            // dispatch the event
            event(new NewMessageEvent(
                $message,
                $conversation->chat_hash,
                Auth::id(),
                Auth::user()->name
            ));

            // return a success JSON response
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully.',
                'data' => [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_id' => $message->sender_id,
                    'sender_name' => Auth::user()->name,
                    'is_current_user' => true,
                    'created_at' => $message->created_at->format('H:i:s'),
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send message.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message): JsonResponse|RedirectResponse
    {
        try {
            // get conversation
            $conversation = $message->conversation;

            // delete message
            $message->delete();            

            // dispatch the event
            event(new MessageDeletedEvent(
                $message->id,
                $conversation->chat_hash,
                Auth::id(),
                Auth::user()->name
            ));

            // return a success JSON response
            return response()->json([
                'success' => true,
                'message' => 'Message deleted successfully.',
                'message_id' => $message->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete message.'
            ], 500);
        }
    }
}
