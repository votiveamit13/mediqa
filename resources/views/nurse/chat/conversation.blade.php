@extends('nurse.layouts.layout')

@section('title', 'Chat - ' . ($otherParticipant->name ?? 'Conversation'))

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
            padding: 15px 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-back {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-back:hover {
            color: #0056b3;
        }

        .chat-search {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 13px;
        }

        .chat-search:focus {
            outline: none;
            border-color: #007bff;
        }

        .conversation-list {
            flex: 1;
            overflow-y: auto;
        }

        .conversation-item-compact {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            cursor: pointer;
            transition: background 0.2s;
            border-bottom: 1px solid #f5f5f5;
        }

        .conversation-item-compact:hover {
            background: #f8f9fa;
        }

        .conversation-item-compact.active {
            background: #007bff;
            color: #fff;
        }

        .conversation-avatar-compact {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 12px;
            object-fit: cover;
        }

        .conversation-info-compact {
            flex: 1;
            overflow: hidden;
        }

        .conversation-name-compact {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .conversation-last-message-compact {
            color: #888;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .conversation-item-compact.active .conversation-last-message-compact {
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

        .chat-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-header-title {
            font-size: 18px;
            font-weight: 600;
        }

        .chat-header-subtitle {
            font-size: 13px;
            color: #28a745;
            margin-top: 3px;
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

        .message.sent {
            flex-direction: row-reverse;
        }

        .message.sent .message-avatar {
            margin-right: 0;
            margin-left: 12px;
        }

        .message.sent .message-content {
            background: #f1f3f4;
            color: #635454;
        }

        .message.received .message-content {
            background: #f1f3f4;
            color: #635454;
        }

        .message-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 12px;
            object-fit: cover;
        }

        .message-content {
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

        .typing-indicator {
            display: none;
            padding: 10px 30px;
            font-size: 13px;
            color: #888;
            font-style: italic;
        }

        .btn-attach {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 18px;
            padding: 8px;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .btn-attach:hover {
            background: #f0f0f0;
            color: #007bff;
        }

        .message-file {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            margin-top: 8px;
            max-width: 300px;
        }

        .message-file .file-icon {
            font-size: 24px;
            color: #007bff;
        }

        .message-file .file-info {
            flex: 1;
            overflow: hidden;
        }

        .message-file .file-name {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .message-file .file-size {
            font-size: 11px;
            color: #888;
        }

        .message-file a {
            color: #007bff;
            text-decoration: none;
        }

        .message-file a:hover {
            text-decoration: underline;
        }

        .message-image {
            max-width: 300px;
            border-radius: 8px;
            margin-top: 8px;
            cursor: pointer;
        }

        .message-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .file-upload-progress {
            display: none;
            padding: 10px;
            background: #f0f0f0;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: #28a745;
            width: 0%;
            transition: width 0.3s;
        }

        /* Message Status Ticks */
        .message-status {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 4px;
            font-size: 14px;
        }

        .message-status i {
            color: #999;
            transition: color 0.3s ease;
        }

        /* Single tick - sent */
        .message-status i.sent {
            color: #999;
        }

        /* Double tick - delivered */
        .message-status i.delivered {
            color: #999;
        }

        /* Double blue tick - read */
        .message-status i.read {
            color: #53bdeb;
        }
    </style>

    <div class="chat-wrapper">
        <!-- Sidebar -->
        <div class="chat-sidebar">
            <div class="chat-sidebar-header">
                <button class="btn-back" onclick="window.location.href='{{ route('nurse.chat.index') }}'">
                    <i class="fi fi-rr-arrow-left"></i> Back
                </button>
            </div>

            <div class="conversation-list-compact" id="conversationList">
                @php
                    $allConversations = \App\Models\Conversation::with(['healthcare', 'latestMessage'])
                        ->where('nurse_id', Auth::guard('nurse_middle')->id())
                        ->where('nurse_deleted', 0)
                        ->orderBy('last_message_at', 'desc')
                        ->limit(10)
                        ->get();
                @endphp

                @foreach($allConversations as $conv)
                    @if($conv->id !== $conversation->id)
                        @php
                            $other = $conv->getOtherParticipant(Auth::guard('nurse_middle')->id());
                            $unread = $conv->unreadCount(Auth::guard('nurse_middle')->id());
                        @endphp
                        <div class="conversation-item-compact {{ $conv->id == $conversation->id ? 'active' : '' }}"
                            data-conversation-id="{{ $conv->id }}"
                            onclick="window.location.href='{{ route('nurse.chat.show', $conv->id) }}'">
                            <img src="{{ ($other->profile_img && $other->profile_img !== 'nurse/assets/imgs/nurse06.png') ? asset('healthcareimg/uploads/' . $other->profile_img) : asset('/nurse/assets/imgs/nurse06.png') }}" alt="{{ $other->name }}"
                                class="conversation-avatar-compact">

                            <div class="conversation-info-compact">
                                <div class="conversation-name-compact">{{ $other->name }} {{ $other->lastname ?? '' }}</div>
                                @if($conv->latestMessage)
                                    <div class="conversation-last-message-compact" id="last-message-{{ $conv->id }}">
                                        @if($conv->latestMessage->sender_id == Auth::guard('nurse_middle')->id())
                                            <span class="sidebar-tick" id="sidebar-tick-{{ $conv->id }}">
                                                @if($conv->latestMessage->is_read)
                                                    <i class="fi fi-rr-check read"></i><i class="fi fi-rr-check read"></i>
                                                @elseif($conv->latestMessage->is_delivered)
                                                    <i class="fi fi-rr-check delivered"></i><i class="fi fi-rr-check delivered"></i>
                                                @else
                                                    <i class="fi fi-rr-check sent"></i>
                                                @endif
                                            </span>
                                        @endif
                                        <span class="last-message-text">{{ Str::limit($conv->latestMessage->message, 30) }}</span>
                                    </div>
                                @endif
                            </div>
                            <span class="sidebar-unread-count" id="unread-count-{{ $conv->id }}"
                                style="background: #007bff; color: #fff; font-size: 11px; padding: 2px 6px; border-radius: 10px; {{ $unread > 0 ? '' : 'display: none;' }}">{{ $unread }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="chat-main">
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="chat-user-info">
                    <img src="{{ $otherParticipant->profile_img
                        ? asset('healthcareimg/uploads/' . $otherParticipant->profile_img)
                        : 'nurse/assets/imgs/nurse06.png' }}"
                        alt="{{ $otherParticipant->name }}"
                        class="chat-user-avatar">
                    <div>
                        <div class="chat-header-title">{{ $otherParticipant->name }} {{ $otherParticipant->lastname ?? '' }}
                            <!-- @if($conversation->job)
                                <span style="font-size: 14px; color: #888; font-weight: normal; margin-left: 10px;">
                                    - {{ $conversation->job->title ?? $conversation->job->job_title ?? '' }}
                                </span>
                            @endif -->
                        </div>
                        <div class="chat-header-subtitle online-status" id="userStatusContainer" data-user-id="{{ $otherParticipant->id }}">
                            <i class="fi fi-rr-circle" id="status-icon" style="font-size: 8px; color: {{ $isOnline ? '#28a745' : '#888' }};"></i>
                            <span id="status-text">{{ $isOnline ? 'Online' : 'Offline' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="chat-messages" id="chatMessages">
                @foreach($conversation->messages as $message)
                    @if(!$message->deleted_by_sender && !$message->deleted_by_receiver)
                        @php
                            $isSent = $message->sender_id == Auth::guard('nurse_middle')->id();
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
                        <div class="message {{ $isSent ? 'sent' : 'received' }}" data-message-id="{{ $message->id }}">
                            @if(!$isSent)
                                <img src="{{ $message->sender->profile_img
                                    ? asset('healthcareimg/uploads/' . $message->sender->profile_img)
                                    : 'nurse/assets/imgs/nurse06.png' }}"
                                    alt="{{ $message->sender->name }}" class="message-avatar">
                            @endif
                            <div class="message-content">
                                <div class="message-header">
                                    @if(!$isSent)
                                        <span class="sender-name">{{ $message->sender->name }} {{ $message->sender->lastname ?? '' }}</span>
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
                                        $isImage = str_starts_with($attachment->file_type, 'image/');
                                    @endphp
                                    @if($isImage)
                                        <div class="message-image">
                                            <img src="{{ asset($attachment->file_path) }}" alt="{{ $attachment->file_name }}" onclick="window.open(this.src)">
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
                                @if($isSent)
                                    <div class="message-status" data-status="{{ $tickStatus }}">
                                        @if($tickStatus === 'read')
                                            <i class="fi fi-rr-check read"></i>
                                            <i class="fi fi-rr-check read"></i>
                                        @elseif($tickStatus === 'delivered')
                                            <i class="fi fi-rr-check delivered"></i>
                                            <i class="fi fi-rr-check delivered"></i>
                                        @else
                                            <i class="fi fi-rr-check sent"></i>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            @if($isSent)
                                <img src="{{ asset(Auth::guard('nurse_middle')->user()->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}"
                                    alt="{{ Auth::guard('nurse_middle')->user()->name }}" class="message-avatar">
                            @endif
                        </div>
                    @endif
                @endforeach

                <!-- Typing Indicator -->
                <div class="typing-indicator" id="typingIndicator">
                    <i class="fi fi-rr-circle"></i> {{ $otherParticipant->name }} is typing...
                </div>
            </div>

            <!-- Chat Input -->
            <div class="chat-input-area">
                <form id="messageForm" style="display: flex; gap: 15px; width: 100%;" onsubmit="return false;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                    <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                    <button type="button" id="attachBtn" class="btn-attach" title="Attach file">
                        <i class="fi fi-rr-clip"></i>
                    </button>
                    <input type="file" id="fileInput" style="display: none;" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.txt,.csv">
                    <input type="text" name="message" class="chat-input" placeholder="Type message" id="messageInput" autocomplete="off">
                    <button type="button" id="sendBtn" class="btn-send">Send</button>
                </form>
                <div class="file-upload-progress" id="uploadProgress">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 12px;">
                        <span id="uploadFileName">Uploading...</span>
                        <span id="uploadPercent">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" id="progressBarFill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- Chat functionality - Echo already loaded in layout --}}
<script>
(function () {
    'use strict';

    function initializeChat() {
        const messageInput      = document.getElementById('messageInput');
        const submitBtn         = document.getElementById('sendBtn');
        const messagesContainer = document.getElementById('chatMessages');
        const attachBtn         = document.getElementById('attachBtn');
        const fileInput         = document.getElementById('fileInput');
        const uploadProgress    = document.getElementById('uploadProgress');
        const uploadFileName    = document.getElementById('uploadFileName');
        const uploadPercent     = document.getElementById('uploadPercent');
        const progressBarFill   = document.getElementById('progressBarFill');

        if (!messageInput || !submitBtn || !messagesContainer) {
            console.error('Chat elements not found');
            return;
        }

        const CONVERSATION_ID = {{ $conversation->id }};
        const MY_USER_ID      = {{ Auth::guard('nurse_middle')->id() }};
        const CSRF_TOKEN      = '{{ csrf_token() }}';
        const SEND_URL        = '{{ route("nurse.chat.send") }}';
        const UPLOAD_URL      = '{{ route("nurse.chat.upload") }}';
        const HEARTBEAT_URL   = '{{ route("nurse.chat.online_status") }}';
        const OTHER_USER_ID   = {{ $otherParticipant->id }};
        const BASE_URL        = '{{ asset("") }}';
        const MY_AVATAR       = '{{ Auth::guard('nurse_middle')->user()->profile_img
                                    && Auth::guard('nurse_middle')->user()->profile_img !== 'nurse/assets/imgs/nurse06.png'
                                    ? asset('healthcareimg/uploads/' . Auth::guard('nurse_middle')->user()->profile_img)
                                    : asset('nurse/assets/imgs/nurse06.png') }}';

        // Scroll to bottom on load
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Get file icon class based on mime type
        function getFileIcon(mimeType) {
            if (mimeType.startsWith('image/')) return 'fi fi-rr-image';
            if (mimeType === 'application/pdf') return 'fi fi-rr-file-pdf';
            if (mimeType.startsWith('text/')) return 'fi fi-rr-file-alt';
            if (mimeType.includes('word')) return 'fi fi-rr-file-word';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'fi fi-rr-file-excel';
            if (mimeType.includes('powerpoint')) return 'fi fi-rr-file-powerpoint';
            return 'fi fi-rr-file';
        }

        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 B';
            var units = ['B', 'KB', 'MB', 'GB'];
            var i = 0;
            while (bytes > 1024) {
                bytes /= 1024;
                i++;
            }
            return bytes.toFixed(2) + ' ' + units[i];
        }

        // Append a text message bubble to chat
        function appendMessage(isSent, text, id, avatar, name) {
            var div = document.createElement('div');
            div.className = 'message ' + (isSent ? 'sent' : 'received');
            if (id) div.setAttribute('data-message-id', id);

            var img = document.createElement('img');
            img.src       = avatar;
            img.alt       = name;
            img.className = 'message-avatar';

            var bubble = document.createElement('div');
            bubble.className = 'message-content';

            var p = document.createElement('p');
            p.className   = 'message-text';
            p.textContent = text;
            bubble.appendChild(p);

            if (isSent) {
                // Add status ticks
                var statusDiv = document.createElement('div');
                statusDiv.className = 'message-status';
                statusDiv.setAttribute('data-status', 'sent');
                statusDiv.innerHTML = '<i class="fi fi-rr-check sent"></i>';
                bubble.appendChild(statusDiv);

                div.appendChild(bubble);
                div.appendChild(img);
            } else {
                div.appendChild(img);
                div.appendChild(bubble);
            }

            messagesContainer.appendChild(div);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Append a file message to chat
        function appendFileMessage(isSent, fileName, fileSize, fileUrl, isImage, imageUrl, id, avatar, name) {
            var div = document.createElement('div');
            div.className = 'message ' + (isSent ? 'sent' : 'received');
            if (id) div.setAttribute('data-message-id', id);

            var img = document.createElement('img');
            img.src       = avatar;
            img.alt       = name;
            img.className = 'message-avatar';

            var bubble = document.createElement('div');
            bubble.className = 'message-content';

            var p = document.createElement('p');
            p.className   = 'message-text';
            p.textContent = isImage ? 'Image' : 'File: ' + fileName;
            bubble.appendChild(p);

            if (isImage) {
                var imgDiv = document.createElement('div');
                imgDiv.className = 'message-image';
                var innerImg = document.createElement('img');
                innerImg.src = imageUrl;
                innerImg.onclick = function() { window.open(this.src); };
                imgDiv.appendChild(innerImg);
                bubble.appendChild(imgDiv);
            } else {
                var fileDiv = document.createElement('div');
                fileDiv.className = 'message-file';

                var icon = document.createElement('i');
                icon.className = 'file-icon fi fi-rr-file';
                fileDiv.appendChild(icon);

                var fileInfo = document.createElement('div');
                fileInfo.className = 'file-info';

                var fName = document.createElement('div');
                fName.className = 'file-name';
                fName.textContent = fileName;
                fileInfo.appendChild(fName);

                var fSize = document.createElement('div');
                fSize.className = 'file-size';
                fSize.textContent = fileSize;
                fileInfo.appendChild(fSize);

                fileDiv.appendChild(fileInfo);

                var downloadLink = document.createElement('a');
                downloadLink.href = fileUrl;
                downloadLink.download = fileName;
                downloadLink.innerHTML = '<i class="fi fi-rr-download"></i>';
                fileDiv.appendChild(downloadLink);

                bubble.appendChild(fileDiv);
            }

            if (isSent) {
                // Add status ticks
                var statusDiv = document.createElement('div');
                statusDiv.className = 'message-status';
                statusDiv.setAttribute('data-status', 'sent');
                statusDiv.innerHTML = '<i class="fi fi-rr-check sent"></i>';
                bubble.appendChild(statusDiv);

                div.appendChild(bubble);
                div.appendChild(img);
            } else {
                div.appendChild(img);
                div.appendChild(bubble);
            }

            messagesContainer.appendChild(div);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Send message via fetch
        function sendMessage() {
            var message = messageInput.value.trim();
            if (!message) return;

            var formData = new FormData();
            formData.append('conversation_id', CONVERSATION_ID);
            formData.append('message', message);
            formData.append('_token', CSRF_TOKEN);

            submitBtn.disabled    = true;
            submitBtn.textContent = 'Sending...';

            fetch(SEND_URL, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(r) {
                if (!r.ok) throw new Error('HTTP ' + r.status);
                return r.json();
            })
            .then(function(data) {
                if (data.success && data.message) {
                    appendMessage(true, data.message.message, data.message.id, MY_AVATAR, data.message.sender.name);
                    messageInput.value = '';

                    // Trigger message visible check if implemented
                } else {
                    alert(data.error || 'Failed to send message');
                }
            })
            .catch(function(err) {
                alert('Send failed: ' + err.message);
            })
            .finally(function() {
                submitBtn.disabled    = false;
                submitBtn.textContent = 'Send';
            });
        }

        // Upload file via fetch
        function uploadFile(file) {
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB');
                return;
            }

            var formData = new FormData();
            formData.append('conversation_id', CONVERSATION_ID);
            formData.append('file', file);
            formData.append('_token', CSRF_TOKEN);

            var xhr = new XMLHttpRequest();

            // Progress tracking
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    var percent = Math.round((e.loaded / e.total) * 100);
                    uploadFileName.textContent = file.name;
                    uploadPercent.textContent = percent + '%';
                    progressBarFill.style.width = percent + '%';
                }
            });

            xhr.addEventListener('load', function() {
                uploadProgress.style.display = 'none';
                progressBarFill.style.width = '0%';
                uploadPercent.textContent = '0%';

                try {
                    var data = JSON.parse(xhr.responseText);
                    if (data.success && data.message) {
                        var msg = data.message;
                        var isImage = msg.message_type === 'image' || (msg.attachments && msg.attachments[0] && msg.attachments[0].file_type && msg.attachments[0].file_type.startsWith('image/'));
                        var fileUrl = msg.file_url || (msg.attachments && msg.attachments[0] ? BASE_URL + msg.attachments[0].file_path : '');
                        var imageUrl = isImage ? fileUrl : null;
                        var fileSize = formatFileSize(file.size);
                        var senderName = msg.sender ? (msg.sender.name || window.Laravel.userName) : window.Laravel.userName;

                        appendFileMessage(true, msg.file_name || file.name, fileSize, fileUrl, isImage, imageUrl, msg.id, MY_AVATAR, senderName);
                    } else {
                        alert(data.error || 'Failed to upload file');
                    }
                } catch (err) {
                    console.error('Upload error:', err);
                    alert('Upload failed: ' + err.message);
                }
            });

            xhr.addEventListener('error', function() {
                uploadProgress.style.display = 'none';
                progressBarFill.style.width = '0%';
                uploadPercent.textContent = '0%';
                alert('Upload failed: Network error');
            });

            xhr.open('POST', UPLOAD_URL);
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            uploadProgress.style.display = 'block';
            xhr.send(formData);
        }

        // Click and Enter listeners
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sendMessage();
        });

        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
        });

        // File upload listeners
        if (attachBtn && fileInput) {
            attachBtn.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    uploadFile(this.files[0]);
                    this.value = '';
                }
            });
        }

        // Real-time incoming messages via Echo
        if (typeof Echo !== 'undefined') {
            // Listen for messages in current conversation
            Echo.private('conversation.' + CONVERSATION_ID)
                .listen('.message.sent', function(data) {
                    if (data.sender_id == MY_USER_ID) return;
                    var avatar = data.sender_avatar
                        ? BASE_URL + 'healthcareimg/uploads/' + data.sender_avatar
                        : BASE_URL + 'nurse/assets/imgs/nurse06.png';

                    // Check if it's a file message
                    if (data.message_type === 'file' && data.attachments && data.attachments[0]) {
                        var attachment = data.attachments[0];
                        var isImage = attachment.file_type && attachment.file_type.startsWith('image/');
                        var fileUrl = attachment.file_url || (BASE_URL + attachment.file_path);
                        var imageUrl = isImage ? fileUrl : null;
                        var fileSize = formatFileSize(attachment.file_size);

                        appendFileMessage(false, attachment.file_name, fileSize, fileUrl, isImage, imageUrl, data.id, avatar, data.sender_name);
                    } else {
                        appendMessage(false, data.message, data.id, avatar, data.sender_name);
                    }

                    // Mark message as read when received in active conversation
                    markMessageAsRead(data.id);
                })
                .listen('.message.status.updated', function(data) {
                    console.log('Message status updated:', data);
                    updateMessageStatus(data.message_ids, data.status);

                    // Also update sidebar ticks if applicable
                    data.message_ids.forEach(function(id) {
                        const sidebarTick = document.getElementById('sidebar-tick-' + data.conversation_id);
                        if (sidebarTick) {
                            if (data.status === 'read') {
                                sidebarTick.innerHTML = '<i class="fi fi-rr-check-double read"></i>';
                            } else if (data.status === 'delivered') {
                                sidebarTick.innerHTML = '<i class="fi fi-rr-check-double delivered"></i>';
                            }
                        }
                    });
                });

            // Listen for messages site-wide (for sidebar updates in other conversations)
            Echo.private('user.' + MY_USER_ID)
                .listen('.message.sent', function(data) {
                    console.log('Site-wide message:', data);

                    // Update sidebar message preview and unread count
                    const lastMsgEl = document.getElementById('last-message-' + data.conversation_id);
                    const unreadEl = document.getElementById('unread-count-' + data.conversation_id);

                    if (lastMsgEl) {
                        // Update preview text
                        const textEl = lastMsgEl.querySelector('.last-message-text');
                        if (textEl) textEl.textContent = data.message.substring(0, 30) + (data.message.length > 30 ? '...' : '');

                        // Update tick (if sent by me, though usually user channel is for incoming)
                        const tickEl = document.getElementById('sidebar-tick-' + data.conversation_id);
                        if (data.sender_id == MY_USER_ID) {
                            if (!tickEl) {
                                lastMsgEl.insertAdjacentHTML('afterbegin', '<span class="sidebar-tick" id="sidebar-tick-' + data.conversation_id + '"><i class="fi fi-rr-check sent"></i></span>');
                            } else {
                                tickEl.innerHTML = '<i class="fi fi-rr-check sent"></i>';
                            }
                        } else if (tickEl) {
                            tickEl.remove(); // Not sent by me, remove tick
                        }
                    }

                    // Update unread count if not the current conversation
                    if (data.conversation_id != CONVERSATION_ID && unreadEl) {
                        let count = parseInt(unreadEl.textContent) || 0;
                        unreadEl.textContent = count + 1;
                        unreadEl.style.display = 'inline-block';
                    }
                });

            // Online status
            Echo.join('users.online')
                .here(function(users) {
                    var online = users.some(function(u) { return u.id == OTHER_USER_ID; });
                    setStatus(online);
                })
                .joining(function(user) { if (user.id == OTHER_USER_ID) setStatus(true);  })
                .leaving(function(user)  { if (user.id == OTHER_USER_ID) setStatus(false); });
        }

        // Mark message as read
        function markMessageAsRead(messageId) {
            fetch('{{ route("nurse.chat.message_read") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message_id: messageId })
            }).catch(function(err) {
                console.error('Failed to mark message as read:', err);
            });
        }

        // Update message status in UI
        function updateMessageStatus(messageIds, status) {
            messageIds.forEach(function(id) {
                var messageEl = document.querySelector('.message.sent[data-message-id="' + id + '"]');
                if (messageEl) {
                    var statusEl = messageEl.querySelector('.message-status');
                    if (statusEl) {
                        statusEl.setAttribute('data-status', status);
                        if (status === 'read') {
                            statusEl.innerHTML = '<i class="fi fi-rr-check read"></i><i class="fi fi-rr-check read"></i>';
                        } else if (status === 'delivered') {
                            statusEl.innerHTML = '<i class="fi fi-rr-check delivered"></i><i class="fi fi-rr-check delivered"></i>';
                        }
                    }
                }
            });
        }

        function setStatus(online) {
            var icon = document.getElementById('status-icon');
            var text = document.getElementById('status-text');
            if (!icon || !text) return;
            icon.style.color = online ? '#28a745' : '#888';
            text.textContent = online ? 'Online' : 'Offline';
        }

        // Heartbeat
        function heartbeat() {
            fetch(HEARTBEAT_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ is_online: true })
            }).catch(function() {});
        }
        heartbeat();
        setInterval(heartbeat, 120000);

        window.addEventListener('beforeunload', function() {
            navigator.sendBeacon(HEARTBEAT_URL, JSON.stringify({ is_online: false }));
        });

        console.log('✅ Chat ready with file upload, conversation: ' + CONVERSATION_ID);
    }

    // Safe init - works whether DOM is ready or not
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeChat);
    } else {
        initializeChat();
    }

})();
</script>
@endsection
