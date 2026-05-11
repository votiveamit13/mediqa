@extends('nurse.layouts.layout')

@section('title', 'Chat - ' . ($otherParticipant->name ?? 'Conversation'))

@section('content')
    <style>
        .chat-wrapper {
            display: flex;
            height: calc(100vh - 155px);
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
            color: #000;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

                /*
            .btn-back:hover {
                color: #0056b3;
            } */

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
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .chat-header-title {
            font-size: 16px;
            font-weight: 600;
        }

        .chat-header-subtitle {
            font-size: 13px;
            color: #dc3545;
        }

        .chat-messages {
            flex: 1;
            padding: 14px 10px;
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
            padding: 10px 12px;
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

        .chat-btn {
            background: #000;
            color: #fff;
            display: inline-flex;
            transition: all ease-in-out .3s;
            font-size: 13px;
            padding: 5px 12px;
            height: fit-content;
            border: 1px solid #000;
        }

        .chat-btn:hover {
            background: #fff;
            border: 1px solid #000;
            color: #000;
        }

        .chat__input {
            display: flex;
            gap: 15px;
            width: 100%;
            align-items: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
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
                <button class="btn-back"
                    onclick="window.location.href='{{ Auth::guard('healthcare_facilities')->user()->role === 2 ? route('healthcare.chat.index') : route('nurse.chat.index') }}'">
                    <i class="fi fi-rr-arrow-left"></i> Back
                </button>
            </div>

            <div class="conversation-list-compact" id="conversationList">
                @php
                    $allConversations = \App\Models\Conversation::with(['nurse', 'latestMessage'])
                        ->where('healthcare_id', Auth::guard('healthcare_facilities')->id())
                        ->where('healthcare_deleted', 0)
                        ->orderBy('last_message_at', 'desc')
                        ->limit(10)
                        ->get();
                @endphp

                @foreach($allConversations as $conv)
                    @if($conv->id !== $conversation->id)
                        @php
                            $other = $conv->getOtherParticipant(Auth::guard('healthcare_facilities')->id());
                            $unread = $conv->unreadCount(Auth::guard('healthcare_facilities')->id());
                        @endphp
                        <div class="conversation-item-compact {{ $conv->id == $conversation->id ? 'active' : '' }}"
                            data-conversation-id="{{ $conv->id }}"
                            onclick="window.location.href='{{ route('healthcare.chat.show', $conv->id) }}'">

                            <img src="{{ ($other->profile_img && $other->profile_img !== 'nurse/assets/imgs/nurse06.png') ? asset('healthcareimg/uploads/' . $other->profile_img) : asset('/nurse/assets/imgs/nurse06.png') }}" alt="{{ $other->name }}"
                                class="conversation-avatar-compact">
                            <div class="conversation-info-compact">
                                <div class="conversation-name-compact">{{ $other->name }} {{ $other->lastname ?? '' }}</div>
                                @if($conv->latestMessage)
                                    <div class="conversation-last-message-compact" id="last-message-{{ $conv->id }}">
                                        @if($conv->latestMessage->sender_id == Auth::guard('healthcare_facilities')->id())
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
                    <img src="{{ asset($otherParticipant->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}"
                        alt="{{ $otherParticipant->name }}" class="chat-user-avatar">
                    <div>
                        <div class="chat-header-title">{{ $otherParticipant->name }} {{ $otherParticipant->lastname ?? '' }}
                        </div>
                        <div class="chat-header-subtitle" id="userStatusContainer" data-user-id="{{ $otherParticipant->id }}">
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
                            $isSent = $message->sender_id == Auth::id();
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
                                    ? asset('/' . $message->sender->profile_img)
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
                                        $isImage = $attachment->file_type && str_starts_with($attachment->file_type, 'image/');
                                    @endphp
                                    @if($isImage)
                                        <div class="message-image">
                                            <img src="{{ asset($attachment->file_path) }}" alt="{{ $attachment->file_name }}" onclick="window.open(this.src)" style="max-width: 300px; border-radius: 8px; cursor: pointer;">
                                        </div>
                                    @else
                                        <div class="message-file" style="display: flex; align-items: center; gap: 10px; padding: 10px; background: rgba(0, 0, 0, 0.05); border-radius: 8px; margin-top: 8px; max-width: 300px;">
                                            <i class="file-icon {{ $attachment->file_icon ?? 'fi fi-rr-file' }}" style="font-size: 24px; color: #007bff;"></i>
                                            <div class="file-info" style="flex: 1; overflow: hidden;">
                                                <div class="file-name" style="font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $attachment->file_name }}</div>
                                                <div class="file-size" style="font-size: 11px; color: #888;">{{ $attachment->formatted_file_size }}</div>
                                            </div>
                                            <a href="{{ asset($attachment->file_path) }}" download style="color: #007bff; text-decoration: none;">
                                                <i class="fi fi-rr-download"></i>
                                            </a>
                                        </div>
                                    @endif
                                @endif

                                @if($isSent)
                                    <div class="message-status" data-status="{{ $tickStatus }}">
                                        @if($tickStatus === 'read')
                                            <i class="fi fi-rr-check read"></i><i class="fi fi-rr-check read"></i>
                                        @elseif($tickStatus === 'delivered')
                                            <i class="fi fi-rr-check delivered"></i><i class="fi fi-rr-check delivered"></i>
                                        @else
                                            <i class="fi fi-rr-check sent"></i>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            @if($isSent)
                                <img src="{{ Auth::user()->profile_img
                                    ? asset('healthcareimg/uploads/' . Auth::user()->profile_img)
                                    : 'nurse/assets/imgs/nurse06.png' }}"
                                    alt="{{ Auth::user()->name }}" class="message-avatar">
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
                <form id="messageForm" style="" class="chat__input" method="POST" onsubmit="return false;">
                    @csrf
                    <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                    <button type="button" id="attachBtn" class="btn-attach" title="Attach file" style="background: none; border: none; color: #666; cursor: pointer; font-size: 18px; padding: 8px; border-radius: 50%; margin-right: 10px;">
                        <i class="fi fi-rr-clip"></i>
                    </button>
                    <input type="file" id="fileInput" style="display: none;" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.txt,.csv">
                    <input type="text" name="message" class="chat-input" placeholder="Type message" id="messageInput"
                        autocomplete="off">
                    <button type="button" class="chat-btn" id="sendBtn">Send</button>
                </form>
                <div class="file-upload-progress" id="uploadProgress" style="display: none; padding: 10px; background: #f0f0f0; border-radius: 8px; margin-top: 10px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 12px;">
                        <span id="uploadFileName">Uploading...</span>
                        <span id="uploadPercent">0%</span>
                    </div>
                    <div class="progress-bar" style="width: 100%; height: 4px; background: #e0e0e0; border-radius: 2px; overflow: hidden;">
                        <div class="progress-bar-fill" id="progressBarFill" style="height: 100%; background: #28a745; width: 0%; transition: width 0.3s;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        console.log('Initializing chat...');

        // Echo is already initialized in layout head
        if (!window.Echo) {
            console.error('❌ Echo not found! Something is wrong.');
        } else {
            console.log('✅ Echo already available');
        }

        // ✅ Global Laravel user data
        window.Laravel = {
            userId: {{ Auth::guard('healthcare_facilities')->id() }},
            userName: '{{ Auth::guard('healthcare_facilities')->user()->name }}',
            userRole: {{ Auth::guard('healthcare_facilities')->user()->role }},
            csrfToken: '{{ csrf_token() }}',
            conversationId: {{ $conversation->id }},
            otherParticipantId: {{ $otherParticipant->id }},
            userAvatar: '{{ Auth::guard('healthcare_facilities')->user()->profile_img ?? 'nurse/assets/imgs/nurse06.png' }}'
        };

        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const submitBtn = document.getElementById('sendBtn');
        const attachBtn = document.getElementById('attachBtn');
        const fileInput = document.getElementById('fileInput');
        const uploadProgress = document.getElementById('uploadProgress');
        const uploadFileName = document.getElementById('uploadFileName');
        const uploadPercent = document.getElementById('uploadPercent');
        const progressBarFill = document.getElementById('progressBarFill');
        const messagesContainer = document.getElementById('chatMessages');
        const baseUrl = "{{ asset('') }}";

        if (!messageForm || !messageInput || !submitBtn || !messagesContainer) {
            console.error('Chat elements not found');
            return;
        }

        console.log('Chat elements ready');

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

        // Append file message to chat
        function appendFileMessage(isSent, fileName, fileSize, fileUrl, isImage, imageUrl, id, avatar, name) {
            var div = document.createElement('div');
            div.className = 'message ' + (isSent ? 'sent' : 'received');
            if (id) div.setAttribute('data-message-id', id);

            var img = document.createElement('img');
            img.src = avatar;
            img.alt = name;
            img.className = 'message-avatar';

            var bubble = document.createElement('div');
            bubble.className = 'message-content';

            var p = document.createElement('p');
            p.className = 'message-text';
            p.textContent = isImage ? 'Image' : 'File: ' + fileName;
            bubble.appendChild(p);

            if (isImage) {
                var imgDiv = document.createElement('div');
                imgDiv.className = 'message-image';
                var innerImg = document.createElement('img');
                innerImg.src = imageUrl;
                innerImg.style.maxWidth = '300px';
                innerImg.style.borderRadius = '8px';
                innerImg.style.cursor = 'pointer';
                innerImg.onclick = function() { window.open(this.src); };
                imgDiv.appendChild(innerImg);
                bubble.appendChild(imgDiv);
            } else {
                var fileDiv = document.createElement('div');
                fileDiv.style.cssText = 'display: flex; align-items: center; gap: 10px; padding: 10px; background: rgba(0, 0, 0, 0.05); border-radius: 8px; margin-top: 8px; max-width: 300px;';

                var icon = document.createElement('i');
                icon.className = 'fi fi-rr-file';
                icon.style.cssText = 'font-size: 24px; color: #007bff;';
                fileDiv.appendChild(icon);

                var fileInfo = document.createElement('div');
                fileInfo.style.cssText = 'flex: 1; overflow: hidden;';

                var fName = document.createElement('div');
                fName.className = 'file-name';
                fName.textContent = fileName;
                fName.style.cssText = 'font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;';
                fileInfo.appendChild(fName);

                var fSize = document.createElement('div');
                fSize.className = 'file-size';
                fSize.textContent = fileSize;
                fSize.style.cssText = 'font-size: 11px; color: #888;';
                fileInfo.appendChild(fSize);

                fileDiv.appendChild(fileInfo);

                var downloadLink = document.createElement('a');
                downloadLink.href = fileUrl;
                downloadLink.download = fileName;
                downloadLink.innerHTML = '<i class="fi fi-rr-download"></i>';
                downloadLink.style.cssText = 'color: #007bff; text-decoration: none;';
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

        // Upload file
        function uploadFile(file) {
            if (file.size > 10 * 1024 * 1024) {
                alert('File size must be less than 10MB');
                return;
            }

            var formData = new FormData();
            formData.append('conversation_id', window.Laravel.conversationId);
            formData.append('file', file);
            formData.append('_token', window.Laravel.csrfToken);

            var xhr = new XMLHttpRequest();

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
                        // Don't append here - Pusher will handle it in real-time
                        messageInput.value = '';
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

            xhr.open('POST', '{{ route('healthcare.chat.upload') }}');
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            uploadProgress.style.display = 'block';
            xhr.send(formData);
        }

        // ✅ Listen for real-time messages
        Echo.private('conversation.' + window.Laravel.conversationId)
            .listen('.message.sent', function (data) {
                console.log(data.sender_id, window.Laravel.userId);
                const isSentByMe = data.sender_id == window.Laravel.userId;
                console.log('Sent by me:', isSentByMe);

                const avatar = isSentByMe
                    ? (data.sender_avatar
                        ? baseUrl + 'healthcareimg/uploads/' + data.sender_avatar
                        : baseUrl + 'nurse/assets/imgs/nurse06.png')
                    : baseUrl + 'nurse/assets/imgs/nurse06.png';

                // Check if it's a file message with attachments
                if (data.message_type === 'file' && data.attachments && data.attachments[0]) {
                    var attachment = data.attachments[0];
                    var isImage = attachment.file_type && attachment.file_type.startsWith('image/');
                    var fileUrl = attachment.file_url;
                    var imageUrl = isImage ? fileUrl : null;
                    var fileSize = formatFileSize(attachment.file_size);
                    var senderAvatar = isSentByMe
                        ? (data.sender_avatar ? baseUrl + 'healthcareimg/uploads/' + data.sender_avatar : baseUrl + 'nurse/assets/imgs/nurse06.png')
                        : baseUrl + 'nurse/assets/imgs/nurse06.png';

                    appendFileMessage(isSentByMe, attachment.file_name, fileSize, fileUrl, isImage, imageUrl, data.id, senderAvatar, data.sender_name);
                } else {
                    console.log('Avatar:', avatar);

                    const messageHtml = `
                        <div class="message ${isSentByMe ? 'sent' : 'received'}" data-message-id="${data.id}">
                            ${!isSentByMe ? `<img src="${avatar}" class="message-avatar">` : ''}
                            <div class="message-content">
                                <p class="message-text">${data.message}</p>
                                ${isSentByMe ? `
                                <div class="message-status" data-status="sent">
                                    <i class="fi fi-rr-check sent"></i>
                                </div>
                                ` : ''}
                            </div>
                            ${isSentByMe ? `<img src="${avatar}" class="message-avatar">` : ''}
                        </div>
                    `;

                    messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }

                // 🔔 Notification sound
                if (!isSentByMe) {
                    const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2teleQQAKZXZ8NOmdhoCLJ7a8NOndBoCLJ7a8NOndBoCLJ7a8NOndBoCLJ7a8NOndBoCLJ7a8NOndBoCLJ7a8NOndBoCLJ7a8NOndBoCLJ7a8NOndBoCLJ7a8NOndBoCLJ7a8NOndBo=');
                    audio.play().catch(() => {});

                    // Mark as read if received in active conversation
                    markMessageAsRead(data.id);
                }
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
        Echo.private('user.' + window.Laravel.userId)
            .listen('.message.sent', function(data) {
                console.log('Site-wide message:', data);

                // Update sidebar message preview and unread count
                const lastMsgEl = document.getElementById('last-message-' + data.conversation_id);
                const unreadEl = document.getElementById('unread-count-' + data.conversation_id);

                if (lastMsgEl) {
                    // Update preview text
                    const textEl = lastMsgEl.querySelector('.last-message-text');
                    if (textEl) textEl.textContent = data.message.substring(0, 30) + (data.message.length > 30 ? '...' : '');

                    // Update tick (if sent by me)
                    const tickEl = document.getElementById('sidebar-tick-' + data.conversation_id);
                    if (data.sender_id == window.Laravel.userId) {
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
                if (data.conversation_id != window.Laravel.conversationId && unreadEl) {
                    let count = parseInt(unreadEl.textContent) || 0;
                    unreadEl.textContent = count + 1;
                    unreadEl.style.display = 'inline-block';
                }
            });

        // Mark message as read
        function markMessageAsRead(messageId) {
            fetch('{{ route("healthcare.chat.message_read") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken,
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

        // File upload event listeners
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

        // ✅ Send message (ONLY ONE HANDLER)
        // Replace messageForm.addEventListener('submit', ...) with:
        submitBtn.addEventListener('click', function () {

        const formData = new FormData(messageForm);

        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Sending...';

        fetch('{{ route('healthcare.chat.send') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(res => {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(data => {
            if (data.success) {
                messageInput.value = ''; // ✅ Just clear input, Pusher will append the message
            } else {
                alert(data.error || 'Failed to send message');
            }
        })
        .catch(err => {
            console.error('Send error:', err);
            alert('Error: ' + err.message);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Send';
        });
    });

        // Also allow sending with Enter key
        messageInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                submitBtn.click();
            }
        });

        // ✅ Scroll to bottom on load
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // ========== ONLINE STATUS TRACKING ==========

        // Listen to global online status channel (for broadcast events)
        Echo.channel('users.online.global')
            .listen('.user.status', function(data) {
                console.log('Global status update:', data);
                if (data.user_id == window.Laravel.otherParticipantId) {
                    updateOnlineStatusUI(data.is_online);
                }
            });

        // Listen to users.online presence channel (for real-time presence)
        Echo.join('users.online')
            .here(function(users) {
                console.log('Users in online presence:', users);
                users.forEach(function(user) {
                    if (user.id == window.Laravel.otherParticipantId) {
                        updateOnlineStatusUI(true);
                    }
                });
            })
            .joining(function(user) {
                console.log('User joined online:', user);
                if (user.id == window.Laravel.otherParticipantId) {
                    updateOnlineStatusUI(true);
                }
            })
            .leaving(function(user) {
                console.log('User left online:', user);
                if (user.id == window.Laravel.otherParticipantId) {
                    updateOnlineStatusUI(false);
                }
            });

        // Listen to specific user's presence channel
        Echo.join('user.' + window.Laravel.otherParticipantId + '.online')
            .here(function(users) {
                console.log('Users in presence channel:', users);
                const isOnline = users.length > 0;
                updateOnlineStatusUI(isOnline);
            })
            .joining(function(user) {
                if (user.id == window.Laravel.otherParticipantId) {
                    updateOnlineStatusUI(true);
                }
            })
            .leaving(function(user) {
                if (user.id == window.Laravel.otherParticipantId) {
                    updateOnlineStatusUI(false);
                }
            });

        // Function to update online status UI
        function updateOnlineStatusUI(isOnline) {
            console.log('updateOnlineStatusUI called:', isOnline ? 'Online' : 'Offline');

            const statusIcon = document.getElementById('status-icon');
            const statusText = document.getElementById('status-text');
            const statusContainer = document.getElementById('userStatusContainer');

            console.log('Elements found:', {
                statusIcon: !!statusIcon,
                statusText: !!statusText,
                statusContainer: !!statusContainer
            });

            if (statusIcon && statusText) {
                if (isOnline) {
                    statusIcon.style.color = '#28a745';
                    statusText.textContent = 'Online';
                    if (statusContainer) {
                        statusContainer.classList.remove('offline');
                        statusContainer.classList.add('online');
                    }
                } else {
                    statusIcon.style.color = '#888';
                    statusText.textContent = 'Offline';
                    if (statusContainer) {
                        statusContainer.classList.remove('online');
                        statusContainer.classList.add('offline');
                    }
                }
                console.log('✅ Status updated successfully:', isOnline ? 'Online' : 'Offline');
            } else {
                console.error('❌ Status elements not found!');
            }
        }

        // Send heartbeat to keep user online
        function sendHeartbeat() {
            fetch('{{ route("healthcare.chat.online_status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ is_online: true })
            }).catch(err => console.error('Heartbeat failed:', err));
        }

        // Send initial heartbeat and then every 2 minutes
        sendHeartbeat();
        setInterval(sendHeartbeat, 120000);

        // Send offline status when leaving page
        window.addEventListener('beforeunload', function() {
            navigator.sendBeacon('{{ route("healthcare.chat.online_status") }}', JSON.stringify({ is_online: false }));
        });

    });

})();
</script>