@extends('layouts.app')

@section('title', 'Chat - ' . ($otherParticipant->name ?? 'Conversation'))

@section('content')
<div class="chat-container" data-conversation-id="{{ $conversation->id }}">
    <div class="row no-gutters chat-wrapper">
        <!-- Sidebar - Conversation List (Compact) -->
        <div class="col-md-4 col-lg-3 chat-sidebar-compact">
            <div class="conversation-header">
                <a href="{{ route('healthcare.chat.index') }}" class="btn btn-back">
                    <i class="fi fi-rr-arrow-left"></i> Back
                </a>
                <h4>Messages</h4>
            </div>

            <div class="conversation-search-compact">
                <input type="text" class="form-control" placeholder="Search..." id="searchConversations">
            </div>

            <div class="conversation-list-compact" id="conversationList">
                @php
                    $allConversations = \App\Models\Conversation::with(['nurse', 'latestMessage'])
                        ->where('healthcare_id', Auth::id())
                        ->where('healthcare_deleted', 0)
                        ->orderBy('last_message_at', 'desc')
                        ->limit(10)
                        ->get();
                @endphp

                @foreach($allConversations as $conv)
                    @if($conv->id !== $conversation->id)
                        @php
                            $other = $conv->getOtherParticipant(Auth::id());
                            $unread = $conv->unreadCount(Auth::id());
                        @endphp
                        <div class="conversation-item-compact {{ $conv->id == $conversation->id ? 'active' : '' }}"
                             onclick="window.location.href='{{ route('healthcare.chat.show', $conv->id) }}'">
                            <div class="conversation-avatar-compact">
                                <img src="{{ asset($other->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}" alt="{{ $other->name }}">
                            </div>
                            <div class="conversation-info-compact">
                                <h6>{{ $other->name }} {{ $other->lastname ?? '' }}</h6>
                                @if($conv->latestMessage)
                                    <p class="last-message-compact">
                                        {{ Str::limit($conv->latestMessage->message, 25) }}
                                    </p>
                                @endif
                            </div>
                            @if($unread > 0)
                                <span class="badge badge-primary unread-badge-compact">{{ $unread }}</span>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="sidebar-footer">
                <a href="{{ route('healthcare.chat.nurses') }}" class="btn btn-primary btn-block">
                    <i class="fi fi-rr-user-nurse"></i> Browse Nurses
                </a>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="col-md-8 col-lg-9 chat-main">
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="chat-user-info">
                    <img src="{{ asset($otherParticipant->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}" alt="{{ $otherParticipant->name }}">
                    <div>
                        <h5>{{ $otherParticipant->name }} {{ $otherParticipant->lastname ?? '' }}</h5>
                        <span class="online-status {{ $isOnline ? 'online' : 'offline' }}" id="userStatusContainer" data-user-id="{{ $otherParticipant->id }}">
                            <i class="fi fi-rr-circle" id="status-icon" style="color: {{ $isOnline ? '#28a745' : '#888' }};"></i>
                            <span id="status-text">{{ $isOnline ? 'Online' : 'Offline' }}</span>
                        </span>
                    </div>
                </div>
                <div class="chat-actions">
                    <button class="btn btn-sm btn-outline-info" title="View Profile" onclick="viewProfile({{ $otherParticipant->id }})">
                        <i class="fi fi-rr-user"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" title="Block User" data-toggle="modal" data-target="#blockUserModal">
                        <i class="fi fi-rr-ban"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger" title="Delete Conversation" data-toggle="modal" data-target="#deleteConversationModal">
                        <i class="fi fi-rr-trash"></i>
                    </button>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="chat-messages" id="chatMessages">
                @foreach($conversation->messages as $message)
                    @if(!$message->deleted_by_sender && !$message->deleted_by_receiver)
                        @php
                            $isSent = $message->sender_id === Auth::id();
                            $tickStatus = '';
                            if ($isSent) {
                                if ($message->is_read) {
                                    $tickStatus = 'read';
                                } elseif ($message->is_delivered) {
                                    $tickStatus = 'delivered';
                                } else {
                                    $tickStatus = 'sent';
                                }
                            }
                        @endphp
                        <div class="message {{ $isSent ? 'sent' : 'received' }}"
                             data-message-id="{{ $message->id }}">
                            @if($message->sender_id !== Auth::id())
                                <div class="message-avatar">
                                    <img src="{{ asset($message->sender->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}" alt="{{ $message->sender->name }}">
                                </div>
                            @endif
                            <div class="message-content">
                                <div class="message-header">
                                    @if($message->sender_id !== Auth::id())
                                        <span class="sender-name">{{ $message->sender->name }}</span>
                                    @endif
                                    <span class="message-time">
                                        @php
                                            $messageDate = $message->created_at;
                                            if ($messageDate->isToday())
                                                echo $messageDate->format('h:i A');
                                            elseif ($messageDate->isYesterday())
                                                echo 'Yesterday';
                                            else
                                                echo $messageDate->format('d/m/Y');
                                        @endphp
                                    </span>
                                </div>

                                <p class="message-text">{{ nl2br(e($message->message)) }}</p>

                                @if($message->message_type === 'file' && $message->attachments->count() > 0)
                                    @php
                                        $attachment = $message->attachments->first();
                                        $isImage = $attachment->file_type && str_starts_with($attachment->file_type, 'image/');
                                    @endphp
                                    @if($isImage)
                                        <div class="message-image">
                                            <img src="{{ asset($attachment->file_path) }}" alt="{{ $attachment->file_name }}" onclick="window.open(this.src)" style="max-width: 300px; border-radius: 8px; cursor: pointer;">
                                        </div>
                                    @else
                                        <div class="message-file">
                                            <i class="file-icon {{ $attachment->file_icon ?? 'fi fi-rr-file' }}"></i>
                                            <div class="file-info">
                                                <div class="file-name">{{ $attachment->file_name }}</div>
                                                <div class="file-size">{{ $attachment->formatted_file_size }}</div>
                                            </div>
                                            <a href="{{ asset($attachment->file_path) }}" download>
                                                <i class="fi fi-rr-download"></i>
                                            </a>
                                        </div>
                                    @endif
                                @endif

                                @if($message->edited)
                                    <span class="edited-label">(edited)</span>
                                @endif

                                @if($isSent)
                                    <div class="message-status" data-status="{{ $tickStatus }}">
                                        @if($tickStatus === 'read')
                                            <i class="fi fi-rr-check-double read" title="Read"></i>
                                        @elseif($tickStatus === 'delivered')
                                            <i class="fi fi-rr-check-double delivered" title="Delivered"></i>
                                        @else
                                            <i class="fi fi-rr-check sent" title="Sent"></i>
                                        @endif
                                    </div>
                                @endif

                                <!-- Message Actions -->
                                <div class="message-actions">
                                    <button class="btn-action" onclick="replyToMessage({{ $message->id }})" title="Reply">
                                        <i class="fi fi-rr-reply"></i>
                                    </button>
                                    @if($message->sender_id === Auth::id())
                                        <button class="btn-action" onclick="deleteMessage({{ $message->id }})" title="Delete">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Typing Indicator -->
                <div class="typing-indicator" id="typingIndicator" style="display: none;">
                    <div class="typing-bubble">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                    <span class="typing-text">{{ $otherParticipant->name }} is typing...</span>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="chat-input-container">
                <div id="replyPreview" class="reply-preview" style="display: none;">
                    <span>Replying to: <strong id="replyToText"></strong></span>
                    <button type="button" class="btn-close" onclick="cancelReply()">
                        <i class="fi fi-rr-times"></i>
                    </button>
                </div>

                <form id="messageForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">

                    <div class="chat-input-wrapper">
                        <button type="button" class="btn btn-attachment" id="attachFileBtn" title="Attach file">
                            <i class="fi fi-rr-clip"></i>
                        </button>
                        <input type="file" name="file" id="fileInput" style="display: none;" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">

                        <textarea name="message" class="form-control chat-input"
                                  placeholder="Type a message..." rows="1" id="messageInput"
                                  autocomplete="off"></textarea>

                        <button type="button" class="btn btn-emoji" title="Add emoji">
                            <i class="far fa-smile"></i>
                        </button>
                        <button type="submit" class="btn btn-send" id="sendBtn">
                            <i class="fi fi-rr-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Block User Modal -->
<div class="modal fade" id="blockUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Block User</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="blockUserForm">
                @csrf
                <div class="modal-body">
                    <p>Are you sure you want to block <strong>{{ $otherParticipant->name }}</strong>?</p>
                    <p class="text-muted small">They won't be able to send you messages anymore.</p>
                    <div class="form-group">
                        <label for="block_reason">Reason (Optional)</label>
                        <textarea class="form-control" name="reason" id="block_reason" rows="3" placeholder="Why are you blocking this user?"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Block User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Conversation Modal -->
<div class="modal fade" id="deleteConversationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Conversation</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this conversation?</p>
                <p class="text-muted small">This will only delete the conversation from your view.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteConversation()">Delete</button>
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
    userId: {{ Auth::guard('healthcare_facilities')->id() }},
    userName: '{{ Auth::guard('healthcare_facilities')->user()->name }}',
    userRole: {{ Auth::guard('healthcare_facilities')->user()->role }},
    csrfToken: '{{ csrf_token() }}',
    conversationId: {{ $conversation->id }},
    otherParticipantId: {{ $otherParticipant->id }},
    userAvatar: '{{ Auth::guard('healthcare_facilities')->user()->profile_img ?? 'nurse/assets/imgs/nurse06.png' }}'
};

// Initialize chat manager
document.addEventListener('DOMContentLoaded', function() {
    window.chatManager = new ChatManager({{ $conversation->id }});

    // Scroll to bottom
    const chatMessages = document.getElementById('chatMessages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
});

// Block user form handler
$('#blockUserForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '{{ route("healthcare.chat.block") }}',
        type: 'POST',
        data: {
            conversation_id: {{ $conversation->id }},
            reason: $('#block_reason').val(),
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                window.location.href = '{{ route("healthcare.chat.index") }}';
            }
        },
        error: function(xhr) {
            alert('Failed to block user');
        }
    });
});

// Delete conversation
function deleteConversation() {
    $.ajax({
        url: '{{ route("healthcare.chat.delete_conversation") }}',
        type: 'POST',
        data: {
            conversation_id: {{ $conversation->id }},
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                window.location.href = '{{ route("healthcare.chat.index") }}';
            }
        },
        error: function(xhr) {
            alert('Failed to delete conversation');
        }
    });
}

// Delete message
function deleteMessage(messageId) {
    if (!confirm('Are you sure you want to delete this message?')) return;

    $.ajax({
        url: '{{ route("healthcare.chat.delete") }}',
        type: 'POST',
        data: {
            message_id: messageId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                $(`[data-message-id="${messageId}"]`).fadeOut(300, function() {
                    $(this).remove();
                });
            }
        }
    });
}

// Reply to message
let replyToMessageId = null;
function replyToMessage(messageId) {
    const message = $(`[data-message-id="${messageId}"] .message-text`).text();
    replyToMessageId = messageId;
    $('#replyToText').text(message.substring(0, 50) + '...');
    $('#replyPreview').fadeIn();
    $('#messageInput').focus();
}

function cancelReply() {
    replyToMessageId = null;
    $('#replyPreview').fadeOut();
}

// View profile
function viewProfile(userId) {
    window.open('/nurse/profile/' + userId, '_blank');
}
</script>
@endpush
@endsection
