<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'blocker_id',
        'blocked_id',
        'reason',
    ];

    /**
     * Get the user who blocked
     */
    public function blocker()
    {
        return $this->belongsTo(User::class, 'blocker_id');
    }

    /**
     * Get the blocked user
     */
    public function blocked()
    {
        return $this->belongsTo(User::class, 'blocked_id');
    }

    /**
     * Check if user is blocked by another user
     */
    public static function isBlocked($blockerId, $blockedId)
    {
        return self::where('blocker_id', $blockerId)
            ->where('blocked_id', $blockedId)
            ->exists();
    }

    /**
     * Check if either user has blocked the other
     */
    public static function isEitherBlocked($userId1, $userId2)
    {
        return self::where(function($query) use ($userId1, $userId2) {
            $query->where('blocker_id', $userId1)
                  ->where('blocked_id', $userId2);
        })->orWhere(function($query) use ($userId1, $userId2) {
            $query->where('blocker_id', $userId2)
                  ->where('blocked_id', $userId1);
        })->exists();
    }

    /**
     * Block a user
     */
    public static function blockUser($blockerId, $blockedId, $reason = null)
    {
        return self::firstOrCreate(
            [
                'blocker_id' => $blockerId,
                'blocked_id' => $blockedId,
            ],
            ['reason' => $reason]
        );
    }

    /**
     * Unblock a user
     */
    public static function unblockUser($blockerId, $blockedId)
    {
        return self::where('blocker_id', $blockerId)
            ->where('blocked_id', $blockedId)
            ->delete();
    }
}
