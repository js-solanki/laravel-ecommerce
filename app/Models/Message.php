<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['chat_room_id', 'user_id', 'message'];

    // The user who sent the message
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The chat room where the message belongs
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }
}
