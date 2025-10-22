<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent  implements ShouldBroadcast
{
    // use Dispatchable, InteractsWithSockets, SerializesModels;
    use InteractsWithSockets;

    // /**
    //  * Create a new event instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     //
    // }

    // /**
    //  * Get the channels the event should broadcast on.
    //  *
    //  * @return \Illuminate\Broadcasting\Channel|array
    //  */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
     public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        // return new Channel('chat');
        return new Channel('chat-room.' . $this->message->chat_room_id);
    }

     public function broadcastAs()
    {
        return 'message.sent';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'message' => $this->message->message,
            'user' => [
                'id' => $this->message->user->id,
                'name' => $this->message->user->name,
            ],
               'time' => getFormattedTime($this->message->created_at),
        ];
    }
}
