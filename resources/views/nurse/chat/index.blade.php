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

.btn-new-chat {
    background: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
    font-size: 14px;
    cursor: pointer;
    margin-top: 15px;
}

.btn-new-chat:hover {
    background: #0056b3;
}
.online-status.online {
    background-color: #28a745;
}
.online-status.offline {
    background-color: #888;
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
                    $otherParticipant = $conv->getOtherParticipant(Auth::guard('nurse_middle')->id());
                    $unreadCount = $conv->unreadCount(Auth::guard('nurse_middle')->id());
                @endphp
                <div class="conversation-item {{ request()->route('id') == $conv->id ? 'active' : '' }}"
                     onclick="window.location.href='{{ route('nurse.chat.show', $conv->id) }}'">
                    <div style="position: relative;">
                        <img src="{{ ($otherParticipant->profile_img && $otherParticipant->profile_img !== 'nurse/assets/imgs/nurse06.png') ? asset('healthcareimg/uploads/' . $otherParticipant->profile_img) : asset('/nurse/assets/imgs/nurse06.png') }}"
                             alt="{{ $otherParticipant->name }}" class="conversation-avatar">

                        <span class="online-status {{ cache()->get('user_'.$otherParticipant->id.'_online', false) ? 'online' : 'offline' }}"
                              data-user-id="{{ $otherParticipant->id }}"
                              style="position: absolute; bottom: 0; right: 15px; width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff;"></span>
                    </div>
                    <div class="conversation-info">
                        <div class="conversation-name">{{ $otherParticipant->name }} {{ $otherParticipant->lastname ?? '' }}</div>
                        <!-- @if($conv->job)
                            <div style="font-size: 11px; color: #007bff; margin-bottom: 3px;">
                                📋 {{ $conv->job->title ?? $conv->job->job_title ?? '' }}
                            </div>
                        @endif -->
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
                    @if($unreadCount > 0)
                        <span style="background: #ff4757; color: #fff; font-size: 11px; padding: 2px 8px; border-radius: 10px;">{{ $unreadCount }}</span>
                    @endif
                </div>
            @empty
                @if($healthcareFacilities->isEmpty())
                    <div class="no-conversations">
                        <i class="fas fa-inbox"></i>
                        <p>No conversations yet</p>
                        <p class="small text-muted">Apply to jobs to start chatting with healthcare facilities</p>
                        <!-- <a href="" class="btn-new-chat">
                            <i class="fas fa-search"></i> Browse Jobs
                        </a> -->
                    </div>
                @else
                    <div class="no-conversations">
                        <i class="fas fa-comments"></i>
                        <p>Start chatting with healthcare facilities you've applied to!</p>
                        <button class="btn-new-chat" data-toggle="modal" data-target="#newConversationModal">
                            <i class="fas fa-plus"></i> Start New Chat
                        </button>
                    </div>
                @endif
            @endforelse
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="chat-main">
        @if(request()->route('id'))
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="chat-header-title">{{ $otherParticipant->name ?? 'Chat' }}
                    @if($conversation->job)
                        <span style="font-size: 14px; color: #888; font-weight: normal; margin-left: 10px;">
                            - {{ $conversation->job->title ?? $conversation->job->job_title ?? '' }}
                        </span>
                    @endif
                </div>
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
                    <button type="submit" class="btn-send">Send</button>
                </form>
            </div>
        @else
            <!-- Empty State -->
            <div class="no-conversations">
                <i class="fas fa-comments" style="font-size: 80px; color: #ddd; margin-bottom: 20px;"></i>
                <h3 style="color: #666; margin-bottom: 10px;">Select a conversation</h3>
                <p style="color: #999;">Choose from your existing conversations or start a new chat</p>
                @if(!$healthcareFacilities->isEmpty())
                    <button class="btn-new-chat" data-toggle="modal" data-target="#newConversationModal">
                        <i class="fas fa-plus"></i> Start New Chat
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- New Conversation Modal -->
<div class="modal fade" id="newConversationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Start New Conversation</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="newConversationForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient_id">Select Healthcare Facility</label>
                        <select class="form-control" name="recipient_id" id="recipient_id" required>
                            <option value="">Choose a facility...</option>
                            @forelse($healthcareFacilities as $facility)
                                <option value="{{ $facility->id }}"
                                        data-job-title="{{ $facility->job_title ?? '' }}"
                                        data-application-id="{{ $facility->application_id ?? '' }}">
                                    {{ $facility->name }} {{ $facility->lastname ?? '' }}
                                    @if($facility->job_title) - {{ $facility->job_title }} @endif
                                </option>
                            @empty
                                <option value="" disabled>No healthcare facilities available</option>
                            @endforelse
                        </select>
                        @if($healthcareFacilities->isEmpty())
                            <small class="text-muted">
                                You haven't applied to any jobs yet.
                                <a href="{{ route('nurse.find_jobs') }}">Browse jobs</a> and apply to start chatting with healthcare facilities.
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject (Optional)</label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="What's this about?">
                    </div>
                    <div class="form-group">
                        <label for="initial_message">Your Message</label>
                        <textarea class="form-control" name="message" id="initial_message" rows="4" required placeholder="Type your message..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Start Conversation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
@vite(['resources/js/chat.js'])
<script>
window.Laravel = {
    userId: {{ Auth::guard('nurse_middle')->id() }},
    userName: '{{ Auth::guard('nurse_middle')->user()->name }}',
    userEmail: '{{ Auth::guard('nurse_middle')->user()->email }}',
    userRole: {{ Auth::guard('nurse_middle')->user()->role }},
    csrfToken: '{{ csrf_token() }}',
    conversationId: {{ request()->route('id') ?? 'null' }}
};

// Load healthcare facilities when modal opens
$('#newConversationModal').on('show.bs.modal', function() {
    const $select = $('#recipient_id');

    // If already loaded, don't load again
    if ($select.find('option').length > 1) return;

    $select.html('<option value="">Loading...</option>');

    $.ajax({
        url: '{{ route("nurse.chat.get_healthcare") }}',
        type: 'GET',
        success: function(response) {
            if (response.success && response.data.length > 0) {
                let options = '<option value="">Choose a facility...</option>';
                response.data.forEach(function(f) {
                    const jobInfo = f.job_title ? ' - ' + f.job_title : '';
                    options += `<option value="${f.id}" data-job-title="${f.job_title || ''}" data-application-id="${f.application_id || ''}">${f.name} ${f.lastname || ''}${jobInfo}</option>`;
                });
                $select.html(options);
            } else {
                $select.html('<option value="" disabled>No healthcare facilities available</option>');
                $select.after('<small class="text-muted">You haven\'t applied to any jobs yet. <a href="/jobList">Browse jobs</a> and apply to start chatting.</small>');
            }
        },
        error: function(xhr) {
            console.error('Error loading healthcare facilities:', xhr);
            $select.html('<option value="" disabled>Error loading facilities</option>');
        }
    });
});

// New conversation form handler
$('#newConversationForm').on('submit', function(e) {
    e.preventDefault();

    const $selectedOption = $('#recipient_id option:selected');
    const formData = {
        recipient_id: $('#recipient_id').val(),
        subject: $('#subject').val() || 'Job Application Inquiry',
        message: $('#initial_message').val(),
        job_title: $selectedOption.data('job-title') || '',
        application_id: $selectedOption.data('application-id') || '',
        _token: '{{ csrf_token() }}'
    };

    // Show loading state
    const $submitBtn = $(this).find('button[type="submit"]');
    const originalText = $submitBtn.html();
    $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Starting...');

    $.ajax({
        url: '{{ route("nurse.chat.start") }}',
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success || response.conversation_id) {
                window.location.href = '/nurse/chat/conversation/' + (response.conversation_id || response.data.conversation_id);
            } else if (response.exists) {
                window.location.href = '/nurse/chat/conversation/' + response.conversation_id;
            }
        },
        error: function(xhr) {
            const errorMsg = xhr.responseJSON?.error || 'Failed to start conversation';
            alert(errorMsg);
            $submitBtn.prop('disabled', false).html(originalText);
        }
    });
});

// Initialize chat manager
document.addEventListener('DOMContentLoaded', function() {
    window.chatManager = new ChatManager(window.Laravel.conversationId || null);
});

@if(request()->route('id'))
document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chatMessages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
});

document.getElementById('messageForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const messageInput = document.getElementById('messageInput');

    fetch('/nurse/chat/send', {
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

    fetch('/nurse/chat/search?q=' + query)
        .then(response => response.json())
        .then(data => {
            console.log(data);
        });
});
</script>
@endpush
@endsection
