<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'sender_type',
        'message',
        'message_type',
        'file_url',
        'file_name',
        'file_size',
        'is_delivered',
        'delivered_at',
        'is_read',
        'read_at',
        'deleted_by_sender',
        'deleted_by_receiver',
        'edited',
        'edited_at',
    ];

    protected $casts = [
        'is_delivered' => 'boolean',
        'delivered_at' => 'datetime',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'deleted_by_sender' => 'boolean',
        'deleted_by_receiver' => 'boolean',
        'edited' => 'boolean',
        'edited_at' => 'datetime',
    ];

    /**
     * Get the conversation
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Get the sender
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get attachments
     */
    public function attachments()
    {
        return $this->hasMany(MessageAttachment::class);
    }

    /**
     * Mark message as delivered
     */
    public function markAsDelivered()
    {
        if (!$this->is_delivered) {
            $this->update([
                'is_delivered' => 1,
                'delivered_at' => now()
            ]);
        }
    }

    /**
     * Mark message as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => 1,
            'read_at' => now()
        ]);
    }

    /**
     * Get read status for display
     * Returns: 'sent', 'delivered', or 'read'
     */
    public function getReadStatusAttribute()
    {
        if ($this->is_read) {
            return 'read';
        }
        if ($this->is_delivered) {
            return 'delivered';
        }
        return 'sent';
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', 0);
    }

    /**
     * Scope for undelivered messages
     */
    public function scopeUndelivered($query)
    {
        return $query->where('is_delivered', 0);
    }

    /**
     * Scope for text messages only
     */
    public function scopeText($query)
    {
        return $query->where('message_type', 'text');
    }

    /**
     * Scope for file messages
     */
    public function scopeFiles($query)
    {
        return $query->whereIn('message_type', ['file', 'image']);
    }

    /**
     * Scope for not deleted messages
     */
    public function scopeNotDeleted($query, $userId)
    {
        return $query->where(function($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->orWhere(function($subQ) {
                  $subQ->where('deleted_by_receiver', 0)
                       ->orWhereNull('deleted_by_receiver');
              });
        });
    }

    /**
     * Check if message can be deleted by user
     */
    public function canBeDeletedBy($userId)
    {
        return $this->sender_id === $userId;
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) {
            return null;
        }

        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
