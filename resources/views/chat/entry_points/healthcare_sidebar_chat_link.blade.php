<!-- 
    ADD CHAT TO HEALTHCARE SIDEBAR
    File: resources/views/healthcare/layouts/sidebar.blade.php
    Add this to the sidebar menu list
-->

<!-- Add to the sidebar navigation ul -->
<li>
    <a class="btn btn-border aboutus-icon mb-20 profile_tabs {{ request()->routeIs('healthcare.chat.*') ? 'active' : '' }}" 
       href="{{ route('healthcare.chat.index') }}">
        <i class="fi fi-rr-comment-alt-dots"></i> 
        Messages
        @php
            $unreadCount = \App\Models\Message::whereHas('conversation', function($q) {
                $q->where('healthcare_id', Auth::id());
            })->where('sender_id', '!=', Auth::id())
              ->where('is_read', 0)->count();
        @endphp
        @if($unreadCount > 0)
            <span class="badge badge-danger">{{ $unreadCount }}</span>
        @endif
    </a>
</li>
