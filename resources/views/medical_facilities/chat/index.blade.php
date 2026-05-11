@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div class="chat-wrapper">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar - Conversation List -->
            <div class="col-md-4 col-lg-3 chat-sidebar">
                <div class="conversation-header">
                    <h4><i class="fas fa-comments"></i> Messages</h4>
                    <span class="badge badge-primary unread-badge" id="totalUnreadCount">0</span>
                </div>

                <div class="conversation-search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search conversations..." id="searchConversations">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="conversation-actions">
                    <a href="/healthcare-facilities/chat/nurses" class="btn btn-primary btn-block">
                        <i class="fas fa-user-nurse"></i> Browse Nurses
                    </a>
                </div>

                <div class="conversation-list" id="conversationList">
                    @forelse($conversations as $conv)
                        @php
                            $otherParticipant = $conv->getOtherParticipant(Auth::guard('healthcare_facilities')->id());
                            $unreadCount = $conv->unreadCount(Auth::guard('healthcare_facilities')->id());
                        @endphp
                        <div class="conversation-item {{ request()->route('id') == $conv->id ? 'active' : '' }}"
                             data-conversation-id="{{ $conv->id }}"
                             onclick="window.location.href='/healthcare-facilities/chat/conversation/{{ $conv->id }}'">
                            <div class="conversation-avatar">
                                <img src="{{ asset($otherParticipant->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}" alt="{{ $otherParticipant->name }}">
                                <span class="online-status {{ cache()->get('user_'.$otherParticipant->id.'_online', false) ? 'online' : 'offline' }}" data-user-id="{{ $otherParticipant->id }}"></span>
                            </div>
                            <div class="conversation-info">
                                <h5>{{ $otherParticipant->name }} {{ $otherParticipant->lastname ?? '' }}</h5>
                                <p class="last-message">
                                    @if($conv->latestMessage)
                                        @if($conv->latestMessage->message_type === 'file')
                                            <i class="fas fa-paperclip"></i> Attachment
                                        @else
                                            {{ Str::limit($conv->latestMessage->message, 40) }}
                                        @endif
                                    @else
                                        <em>Start a conversation</em>
                                    @endif
                                </p>
                            </div>
                            <div class="conversation-meta">
                                <span class="time">{{ $conv->last_message_at ? $conv->last_message_at->diffForHumans() : '' }}</span>
                                @if($unreadCount > 0)
                                    <span class="badge badge-primary unread-badge">{{ $unreadCount }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="no-conversations">
                            <i class="fas fa-inbox"></i>
                            <p>No conversations yet</p>
                            <p class="small text-muted">Nurses who apply to your jobs will appear here</p>
                            <a href="/healthcare-facilities/chat/nurses" class="btn btn-primary btn-sm">
                                <i class="fas fa-user-nurse"></i> Browse Nurses
                            </a>
                        </div>
                    @endforelse
                </div>

                @if($conversations->hasPages())
                    <div class="pagination-wrapper">
                        {{ $conversations->links() }}
                    </div>
                @endif
            </div>

            <!-- Main Chat Area - Placeholder -->
            <div class="col-md-8 col-lg-9 chat-main">
                <div class="chat-empty-state">
                    <i class="fas fa-comments"></i>
                    <h3>Select a conversation to start chatting</h3>
                    <p>Choose from your existing conversations or start a new chat with a nurse.</p>
                    <a href="{{ route('healthcare.chat.nurses') }}" class="btn btn-primary">
                        <i class="fas fa-user-nurse"></i> Browse Nurses
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endpush

@push('scripts')
@vite(['resources/js/chat.js'])
<script>
window.Laravel = {
    userId: {{ Auth::id() }},
    userName: '{{ Auth::user()->name }}',
    userRole: {{ Auth::user()->role }},
    csrfToken: '{{ csrf_token() }}',
    conversationId: {{ request()->route('id') ?? 'null' }}
};

// Initialize chat manager
document.addEventListener('DOMContentLoaded', function() {
    window.chatManager = new ChatManager(window.Laravel.conversationId || null);
});

// Search conversations
$('#searchConversations').on('input', function() {
    const query = $(this).val();

    if (query.length < 2) {
        $('#conversationList').load(window.location.href + ' #conversationList > *');
        return;
    }

    $.ajax({
        url: '{{ route("healthcare.chat.search") }}',
        type: 'GET',
        data: { q: query },
        success: function(response) {
            let html = '';
            response.conversations.forEach(conv => {
                const otherParticipant = conv.nurse_id === {{ Auth::guard('healthcare_facilities')->id() }} ? conv.healthcare : conv.nurse;
                html += `
                    <div class="conversation-item" data-conversation-id="${conv.id}"
                         onclick="window.location.href='/healthcare-facilities/chat/conversation/${conv.id}'">
                        <div class="conversation-avatar">
                            <img src="${otherParticipant.profile_img}" alt="${otherParticipant.name}">
                        </div>
                        <div class="conversation-info">
                            <h5>${otherParticipant.name} ${otherParticipant.lastname || ''}</h5>
                            <p class="last-message">${conv.latest_message?.message || 'No messages'}</p>
                        </div>
                        <div class="conversation-meta">
                            <span class="time">${new Date(conv.last_message_at).toLocaleDateString()}</span>
                        </div>
                    </div>
                `;
            });
            $('#conversationList').html(html);
        }
    });
});

// Update unread count
function updateUnreadCount() {
    $.ajax({
        url: '/healthcare-facilities/chat/unread-count',
        type: 'GET',
        success: function(response) {
            $('#totalUnreadCount').text(response.unread_count);
            if (response.unread_count > 0) {
                document.title = `(${response.unread_count}) Messages`;
            } else {
                document.title = 'Messages';
            }
        }
    });
}

setInterval(updateUnreadCount, 30000);
updateUnreadCount();
</script>
@endpush
@endsection
