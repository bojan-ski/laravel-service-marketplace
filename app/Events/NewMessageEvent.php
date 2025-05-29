<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class NewMessageEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Message $message, public string $chatHash, public int $senderId, public string $senderName)
    {
        $this->message = $message;
        $this->chatHash = $chatHash;
        $this->senderId = $senderId;
        $this->senderName = $senderName;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->chatHash),
        ];
    }

    // event broadcast name.
    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    // get the data to broadcast.
    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'message' => $this->message->message,
            'sender_id' => $this->message->sender_id,
            'sender_name' => $this->senderName,
            'created_at' => $this->message->created_at->format('H:i:s'),
        ];
    }
}
