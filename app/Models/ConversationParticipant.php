<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'last_read_message_id',
        'unread_count',
        'is_typing',
        'last_seen_at',
    ];

    protected $casts = [
        'is_typing' => 'boolean',
        'last_seen_at' => 'datetime',
    ];

    /**
     * Get the conversation
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Update last read message
     */
    public function updateLastRead($messageId)
    {
        $this->update([
            'last_read_message_id' => $messageId,
            'unread_count' => 0
        ]);
    }

    /**
     * Increment unread count
     */
    public function incrementUnread()
    {
        $this->increment('unread_count');
    }

    /**
     * Reset unread count
     */
    public function resetUnread()
    {
        $this->update(['unread_count' => 0]);
    }

    /**
     * Set typing status
     */
    public function setTyping($isTyping = true)
    {
        $this->update(['is_typing' => $isTyping]);
    }

    /**
     * Update last seen
     */
    public function updateLastSeen()
    {
        $this->update(['last_seen_at' => now()]);
    }
}
