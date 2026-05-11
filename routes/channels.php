<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// ==========================================
// Chat System Broadcast Channels
// ==========================================

// Helper function to get authenticated user from any guard
function getBroadcastUser() {
    return Auth::guard('nurse_middle')->check() ? Auth::guard('nurse_middle')->user() :
           (Auth::guard('healthcare_facilities')->check() ? Auth::guard('healthcare_facilities')->user() :
           (Auth::check() ? Auth::user() : null));
}

// Conversation channel - only participants can access
Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    // The $user parameter comes from the broadcasting auth
    $authenticatedUser = $user ?: getBroadcastUser();

    if (!$authenticatedUser) {
        return false;
    }

    $conversation = App\Models\Conversation::find($conversationId);

    if (!$conversation) {
        return false;
    }

    return in_array($authenticatedUser->id, [$conversation->nurse_id, $conversation->healthcare_id]);
});

// User notification channel
Broadcast::channel('user.{userId}', function ($user, $userId) {
    $authenticatedUser = $user ?: getBroadcastUser();

    if (!$authenticatedUser) {
        return false;
    }

    return (int) $authenticatedUser->id === (int) $userId;
});

// User online status channel
Broadcast::channel('user.{userId}.online', function ($user, $userId) {
    $authenticatedUser = $user ?: getBroadcastUser();

    if (!$authenticatedUser) {
        return false;
    }

    return (int) $authenticatedUser->id === (int) $userId;
});

// Typing status channel - only conversation participants
Broadcast::channel('conversation.{conversationId}.typing', function ($user, $conversationId) {
    $authenticatedUser = $user ?: getBroadcastUser();

    if (!$authenticatedUser) {
        return false;
    }

    $conversation = App\Models\Conversation::find($conversationId);

    if (!$conversation) {
        return false;
    }

    return in_array($authenticatedUser->id, [$conversation->nurse_id, $conversation->healthcare_id]);
});

// Presence channel for conversation
Broadcast::channel('conversation.{conversationId}.presence', function ($user, $conversationId) {
    $authenticatedUser = $user ?: getBroadcastUser();

    if (!$authenticatedUser) {
        return false;
    }

    $conversation = App\Models\Conversation::find($conversationId);

    if (!$conversation) {
        return false;
    }

    if (!in_array($authenticatedUser->id, [$conversation->nurse_id, $conversation->healthcare_id])) {
        return false;
    }

    return [
        'id' => $authenticatedUser->id,
        'name' => $authenticatedUser->name . ' ' . ($authenticatedUser->lastname ?? ''),
        'avatar' => $authenticatedUser->profile_img,
        'role' => $authenticatedUser->role,
    ];
});

// Global online users channel
Broadcast::channel('users.online', function ($user) {
    $authenticatedUser = $user ?: getBroadcastUser();

    if (!$authenticatedUser) {
        return false;
    }

    return [
        'id' => $authenticatedUser->id,
        'name' => $authenticatedUser->name . ' ' . ($authenticatedUser->lastname ?? ''),
        'role' => $authenticatedUser->role,
    ];
});

// Global online status channel (public channel for broadcasts)
Broadcast::channel('users.online.global', function ($user) {
    $authenticatedUser = $user ?: getBroadcastUser();

    // Allow all authenticated users
    return $authenticatedUser !== null;
});
