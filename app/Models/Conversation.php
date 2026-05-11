<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'job_id',
        'nurse_id',
        'healthcare_id',
        'last_message_id',
        'last_message_at',
        'nurse_deleted',
        'healthcare_deleted',
        'nurse_blocked',
        'healthcare_blocked',
        'status',
    ];

    protected $casts = [
        'nurse_deleted' => 'boolean',
        'healthcare_deleted' => 'boolean',
        'nurse_blocked' => 'boolean',
        'healthcare_blocked' => 'boolean',
        'last_message_at' => 'datetime',
    ];

    /**
     * Get all messages in the conversation
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the nurse user
     */
    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }

    /**
     * Get the healthcare user
     */
    public function healthcare()
    {
        return $this->belongsTo(User::class, 'healthcare_id');
    }

    /**
     * Get the related job
     */
    public function job()
    {
        return $this->belongsTo(JobsModel::class, 'job_id');
    }

    /**
     * Get participants
     */
    public function participants()
    {
        return $this->hasMany(ConversationParticipant::class);
    }

    /**
     * Get latest message
     */
    public function latestMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }

    /**
     * Scope for active conversations
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for conversations not deleted by user
     */
    public function scopeNotDeletedBy($query, $userId)
    {
        $user = User::find($userId);
        
        if ($user && $user->role === 1) { // Nurse
            return $query->where('nurse_deleted', 0);
        }
        
        return $query->where('healthcare_deleted', 0);
    }

    /**
     * Get unread count for a user
     */
    public function unreadCount($userId)
    {
        return $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('is_read', 0)
            ->where('deleted_by_receiver', 0)
            ->count();
    }

    /**
     * Get the other participant in the conversation
     */
    public function getOtherParticipant($userId)
    {
        if ($this->nurse_id === $userId) {
            return $this->healthcare;
        }
        
        return $this->nurse;
    }

    /**
     * Check if user is participant
     */
    public function isParticipant($userId)
    {
        return in_array($userId, [$this->nurse_id, $this->healthcare_id]);
    }
}
