<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;

class ChatController extends Controller
{
     public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'chat_room_id' => $request->chat_room_id,
            'user_id' => auth()->id(), // or $request->user_id if testing
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent', 'message' => $message]);
    }
}
