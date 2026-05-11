@extends('nurse.layouts.layout')

@section('title', 'Messages')

@section('content')
<style>
.chat-wrapper {
    display: flex;
    height: calc(100vh - 60px);
    background: #f5f7fa;
}

.chat-sidebar {
    width: 320px;
    background: #fff;
    border-right: 1px solid #e0e0e0;
    display: flex;
    flex-direction: column;
}

.chat-sidebar-header {
    padding: 20px;
    border-bottom: 1px solid #e0e0e0;
}

.chat-search {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 14px;
}

.chat-search:focus {
    outline: none;
    border-color: #007bff;
}

.conversation-list {
    flex: 1;
    overflow-y: auto;
}

.conversation-item {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    cursor: pointer;
    transition: background 0.2s;
    border-bottom: 1px solid #f5f5f5;
}

.conversation-item:hover {
    background: #f8f9fa;
}

.conversation-item.active {
    background: #007bff;
    color: #fff;
}

.conversation-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin-right: 15px;
    object-fit: cover;
}

.conversation-info {
    flex: 1;
    overflow: hidden;
}

.conversation-name {
    font-weight: 600;
    font-size: 15px;
    margin-bottom: 5px;
}

.conversation-last-message {
    color: #888;
    font-size: 13px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.conversation-item.active .conversation-last-message {
    color: #e0e0e0;
}

.chat-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #fff;
}

.chat-header {
    padding: 20px 30px;
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chat-header-title {
    font-size: 18px;
    font-weight: 600;
}

.chat-messages {
    flex: 1;
    padding: 30px;
    overflow-y: auto;
    background: #fff;
}

.message {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
}

.message-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right: 12px;
    object-fit: cover;
}

.message-content {
    background: #f1f3f4;
    padding: 12px 16px;
    border-radius: 12px;
    max-width: 60%;
}

.message-text {
    margin: 0;
    font-size: 14px;
    line-height: 1.5;
}

.chat-input-area {
    padding: 20px 30px;
    border-top: 1px solid #e0e0e0;
    display: flex;
    gap: 15px;
    align-items: center;
}

.chat-input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 14px;
}

.chat-input:focus {
    outline: none;
    border-color: #007bff;
}

.btn-send {
    background: #28a745;
    color: #fff;
    padding: 12px 30px;
    border-radius: 8px;
    border: none;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-send:hover {
    background: #218838;
}

.no-conversations {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #888;
}

.no-conversations i {
    font-size: 60px;
    margin-bottom: 20px;
    color: #ddd;
}
.chat-btn {
    background: #000;
    color: #fff;
    display: inline-flex;
    transition: all ease-in-out .3s;
    font-size: 13px;
    padding: 10px 12px;
}
</style>

<div class="chat-wrapper">
    <!-- Sidebar -->
    <div class="chat-sidebar">
        <div class="chat-sidebar-header">
            <input type="text" class="chat-search" placeholder="Search" id="searchConversations">
        </div>

        <div class="conversation-list" id="conversationList">
            @forelse($conversations as $conv)
                @php
                    $otherParticipant = $conv->getOtherParticipant(Auth::guard('healthcare_facilities')->id());
                    $unreadCount = $conv->unreadCount(Auth::guard('healthcare_facilities')->id());
                @endphp
                <div class="conversation-item {{ request()->route('id') == $conv->id ? 'active' : '' }}"
                     onclick="window.location.href='{{ route('healthcare.chat.show', $conv->id) }}'">
                    <img src="{{ asset($otherParticipant->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}"
                         alt="{{ $otherParticipant->name }}" class="conversation-avatar">
                    <div class="conversation-info">
                        <div class="conversation-name">{{ $otherParticipant->name }} {{ $otherParticipant->lastname ?? '' }}</div>
                        @if($conv->latestMessage)
                            <div class="conversation-last-message">
                                @if($conv->latestMessage->message_type === 'file')
                                    📎 Attachment
                                @else
                                    {{ Str::limit($conv->latestMessage->message, 40) }}
                                @endif
                            </div>
                        @else
                            <div class="conversation-last-message"><em>Start a conversation</em></div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="no-conversations">
                    <i class="fas fa-inbox"></i>
                    <p>No conversations yet</p>
                    <p class="small text-muted">Nurses who apply to your jobs will appear here</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="chat-main">
        @if(request()->route('id'))
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="chat-header-title">{{ $otherParticipant->name ?? 'Chat' }}</div>
            </div>

            <!-- Chat Messages -->
            <div class="chat-messages" id="chatMessages">
                @foreach($conversation->messages as $message)
                    @if(!$message->deleted_by_sender && !$message->deleted_by_receiver)
                        <div class="message">
                            <img src="{{ asset($message->sender->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}"
                                 alt="{{ $message->sender->name }}" class="message-avatar">
                            <div class="message-content">
                                <p class="message-text">{{ nl2br(e($message->message)) }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Chat Input -->
            <div class="chat-input-area">
                <form id="messageForm" style="display: flex; gap: 15px; width: 100%;">
                    @csrf
                    <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                    <input type="text" name="message" class="chat-input" placeholder="Type message" id="messageInput" autocomplete="off">
                    <button type="submit" class="chat-btn">Send</button>
                </form>
            </div>
        @else
            <!-- Empty State -->
            <div class="no-conversations">
                <i class="fas fa-comments" style="font-size: 80px; color: #ddd; margin-bottom: 20px;"></i>
                <h3 style="color: #666; margin-bottom: 10px;">Select a conversation</h3>
                <p style="color: #999;">Choose from your existing conversations to start chatting</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script src="{{ asset('build/assets/chat-baaabaae.js') }}"></script>
<script>
window.Laravel = {
    userId: {{ Auth::guard('healthcare_facilities')->id() }},
    userName: '{{ Auth::guard('healthcare_facilities')->user()->name }}',
    userRole: {{ Auth::guard('healthcare_facilities')->user()->role }},
    csrfToken: '{{ csrf_token() }}'
};

@if(request()->route('id'))
document.addEventListener('DOMContentLoaded', function() {
    window.chatManager = new ChatManager({{ $conversation->id }});

    const chatMessages = document.getElementById('chatMessages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
});

document.getElementById('messageForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const messageInput = document.getElementById('messageInput');

    fetch('/healthcare-facilities/chat/send', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const messagesContainer = document.getElementById('chatMessages');
            const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            const messageHtml = `
                <div class="message">
                    <img src="${data.message.sender.profile_img}" alt="${data.message.sender.name}" class="message-avatar">
                    <div class="message-content">
                        <p class="message-text">${data.message.message}</p>
                    </div>
                </div>
            `;

            messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
            messageInput.value = '';
        }
    })
    .catch(error => console.error('Error:', error));
});
@endif

// Search conversations
document.getElementById('searchConversations').addEventListener('input', function() {
    const query = this.value;
    if (query.length < 2) return;

    fetch('/healthcare-facilities/chat/search?q=' + query)
        .then(response => response.json())
        .then(data => {
            // Update conversation list
            console.log(data);
        });
});
</script>
@endpush
@endsection
