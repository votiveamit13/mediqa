<!-- 
    ADD CHAT TO NURSE HEADER
    File: resources/views/nurse/layouts/header.blade.php
    Find your navigation menu and add this link
-->

<!-- Example: Add to your main navigation menu -->
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('nurse.chat.*') ? 'active' : '' }}" 
       href="{{ route('nurse.chat.index') }}">
        <i class="fas fa-comment-dots"></i>
        <span>Messages</span>
        @php
            $unreadCount = \App\Models\Message::whereHas('conversation', function($q) {
                $q->where('nurse_id', Auth::id());
            })->where('sender_id', '!=', Auth::id())
              ->where('is_read', 0)->count();
        @endphp
        @if($unreadCount > 0)
            <span class="badge badge-danger">{{ $unreadCount }}</span>
        @endif
    </a>
</li>
