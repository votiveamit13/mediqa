/**
 * Chat System - Real-time Messaging
 * MediQa Nurse-Healthcare Chat Application
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Setup Pusher and Echo
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.PUSHER_APP_KEY || 'your-pusher-key',
    cluster: process.env.PUSHER_APP_CLUSTER || 'mt1',
    forceTLS: true,
    encrypted: true,
    authEndpoint: '/broadcasting/auth',
});

/**
 * Chat Manager Class
 * Handles all real-time chat functionality
 */
class ChatManager {
    constructor(conversationId) {
        this.conversationId = conversationId;
        this.typingTimeout = null;
        this.isTyping = false;
        this.lastScrollTop = 0;

        this.init();
    }

    /**
     * Initialize chat manager
     */
    init() {
        this.setupElements();
        this.listenForMessages();
        this.listenForTyping();
        this.listenForPresence();
        this.listenForGlobalPresence();
        this.setupMessageForm();
        this.setupTypingDetection();
        this.setupFileUpload();
        this.setupEmojiPicker();
        this.setupReadObserver();
        this.autoResizeTextarea();
        this.scrollToBottom();
        this.startHeartbeat();

        // Mark all messages as delivered when chat opens
        this.markConversationAsDelivered();
    }

    /**
     * Setup DOM element references
     */
    setupElements() {
        this.chatMessages = document.getElementById('chatMessages');
        this.messageForm = document.getElementById('messageForm');
        this.messageInput = document.getElementById('messageInput');
        this.sendBtn = document.getElementById('sendBtn');
        this.fileInput = document.getElementById('fileInput');
        this.attachFileBtn = document.getElementById('attachFileBtn');
        this.typingIndicator = document.getElementById('typingIndicator');
    }

    /**
     * Listen for incoming messages
     */
    listenForMessages() {
        if (!this.conversationId) return;

        Echo.private(`conversation.${this.conversationId}`)
            .listen('.message.sent', (event) => {
                console.log('Message received:', event);
                this.appendMessage(event);
                this.scrollToBottom();
                this.playNotificationSound();
                this.updateTitleNotification();
            })
            .listen('.message.status.updated', (event) => {
                console.log('Message status updated:', event);
                this.updateMessageTicks(event.message_ids, event.status);
            });
    }

    /**
     * Setup intersection observer to mark messages as read when visible
     */
    setupReadObserver() {
        if (!this.chatMessages) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const messageId = entry.target.dataset.messageId;
                    if (messageId) {
                        this.markMessageAsRead(messageId);
                        observer.unobserve(entry.target);
                    }
                }
            });
        }, {
            root: this.chatMessages,
            threshold: 0.5
        });

        // Observe all received messages
        const messageElements = this.chatMessages.querySelectorAll('.message.received');
        messageElements.forEach(el => observer.observe(el));

        // Re-observe when new messages are added
        const mutationObserver = new MutationObserver((mutations) => {
            mutations.forEach(mutation => {
                mutation.addedNodes.forEach(node => {
                    if (node.nodeType === 1 && node.classList && node.classList.contains('message')) {
                        if (node.classList.contains('received')) {
                            observer.observe(node);
                        }
                    }
                });
            });
        });

        mutationObserver.observe(this.chatMessages, { childList: true });
    }

    /**
     * Listen for typing events
     */
    listenForTyping() {
        if (!this.conversationId) return;

        Echo.join(`conversation.${this.conversationId}.presence`)
            .here((users) => {
                console.log('Users in conversation:', users);
                this.updateOnlineStatus(users);
            })
            .joining((user) => {
                console.log('User joined:', user);
                if (user.id == window.Laravel.otherParticipantId) {
                    this.showUserOnline(true);
                    this.showNotification(user.name + ' is now online');
                }
            })
            .leaving((user) => {
                console.log('User left:', user);
                if (user.id == window.Laravel.otherParticipantId) {
                    this.showUserOnline(false);
                }
            })
            .error((error) => {
                console.error('Presence channel error:', error);
                this.showUserOnline(false);
            })
            .listen('.UserTyping', (event) => {
                this.toggleTypingIndicator(event);
            });
    }

    /**
     * Listen for presence events
     */
    listenForPresence() {
        // Handle presence channel events
    }

    /**
     * Listen for global presence
     */
    listenForGlobalPresence() {
        console.log('Subscribing to global online status channel...');

        // Subscribe to global presence channel
        Echo.join('users.online')
            .here((users) => {
                console.log('Global Online Users:', users);
                users.forEach(user => {
                    this.updateUserStatusIndicator(user.id, true);
                });
            })
            .joining((user) => {
                console.log('Global User Joined:', user);
                this.updateUserStatusIndicator(user.id, true);

                // If it's the other participant in current conversation
                if (window.Laravel?.otherParticipantId == user.id) {
                    this.showUserOnline(true);
                    this.showNotification(user.name + ' is now online');
                }
            })
            .leaving((user) => {
                console.log('Global User Left:', user);
                this.updateUserStatusIndicator(user.id, false);

                if (window.Laravel?.otherParticipantId == user.id) {
                    this.showUserOnline(false);
                }
            })
            .error((error) => {
                console.error('Global presence channel error:', error);
            });

        // Also listen to global online status channel for real-time updates
        Echo.channel('users.online.global')
            .listen('.user.status', (data) => {
                console.log('Global user status update:', data);
                if (data.user_id == window.Laravel?.otherParticipantId) {
                    this.showUserOnline(data.is_online);
                }
            });

        // Also listen to specific user's presence channel
        if (window.Laravel?.otherParticipantId) {
            Echo.join('user.' + window.Laravel.otherParticipantId + '.online')
                .here((users) => {
                    console.log('Users in presence channel for ' + window.Laravel.otherParticipantId + ':', users);
                    const isOnline = users.length > 0;
                    this.showUserOnline(isOnline);
                })
                .joining((user) => {
                    console.log('User joined presence channel:', user);
                    if (user.id == window.Laravel.otherParticipantId) {
                        this.showUserOnline(true);
                    }
                })
                .leaving((user) => {
                    console.log('User left presence channel:', user);
                    if (user.id == window.Laravel.otherParticipantId) {
                        this.showUserOnline(false);
                    }
                });
        }
    }

    /**
     * Update status indicator for a specific user ID
     */
    updateUserStatusIndicator(userId, isOnline) {
        const indicators = document.querySelectorAll(`.online-status[data-user-id="${userId}"]`);
        indicators.forEach(indicator => {
            if (isOnline) {
                indicator.classList.remove('offline');
                indicator.classList.add('online');
            } else {
                indicator.classList.remove('online');
                indicator.classList.add('offline');
            }
        });
    }

    /**
     * Setup message form submission
     */
    setupMessageForm() {
        if (!this.messageForm) return;

        this.messageForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const message = this.messageInput.value.trim();
            if (!message && !this.fileInput.files[0]) return;

            if (this.fileInput.files[0]) {
                this.uploadFile();
            } else {
                this.sendMessage(message);
            }
        });

        // Send on Ctrl+Enter
        this.messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && e.ctrlKey) {
                e.preventDefault();
                this.messageForm.dispatchEvent(new Event('submit'));
            }
        });
    }

    /**
     * Send message via AJAX
     */
    async sendMessage(message) {
        const formData = new FormData();
        formData.append('conversation_id', this.conversationId);
        formData.append('message', message);
        formData.append('_token', window.Laravel.csrfToken);

        try {
            const response = await fetch(this.getSendUrl(), {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const data = await response.json();

            if (data.success) {
                this.appendMessage({
                    ...data.message,
                    sender_id: data.message.sender.id,
                    sender_name: data.message.sender.name,
                    sender_avatar: data.message.sender.profile_img,
                });
                this.messageInput.value = '';
                this.stopTyping();
                this.scrollToBottom();
            }
        } catch (error) {
            console.error('Error sending message:', error);
            this.showError('Failed to send message');
        }
    }

    /**
     * Upload file attachment
     */
    async uploadFile() {
        const file = this.fileInput.files[0];
        if (!file) return;

        // Validate file size (10MB max)
        if (file.size > 10 * 1024 * 1024) {
            this.showError('File size must be less than 10MB');
            return;
        }

        const formData = new FormData();
        formData.append('conversation_id', this.conversationId);
        formData.append('file', file);
        formData.append('_token', window.Laravel.csrfToken);

        try {
            const response = await fetch(this.getUploadUrl(), {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const data = await response.json();

            if (data.success) {
                this.appendMessage({
                    ...data.message,
                    sender_id: data.message.sender.id,
                    sender_name: data.message.sender.name,
                    sender_avatar: data.message.sender.profile_img,
                });
                this.fileInput.value = '';
                this.scrollToBottom();
            }
        } catch (error) {
            console.error('Error uploading file:', error);
            this.showError('Failed to upload file');
        }
    }

    /**
     * Setup typing detection
     */
    setupTypingDetection() {
        if (!this.messageInput) return;

        this.messageInput.addEventListener('input', () => {
            this.startTyping();
        });

        this.messageInput.addEventListener('blur', () => {
            this.stopTyping();
        });

        this.messageInput.addEventListener('focus', () => {
            // Mark messages as read when focusing on chat
            this.markAsRead();
        });
    }

    /**
     * Start typing indicator
     */
    startTyping() {
        if (this.typingTimeout) {
            clearTimeout(this.typingTimeout);
        }

        if (!this.isTyping) {
            this.isTyping = true;
            this.broadcastTyping(true);
        }

        this.typingTimeout = setTimeout(() => {
            this.stopTyping();
        }, 2000);
    }

    /**
     * Stop typing indicator
     */
    stopTyping() {
        if (this.typingTimeout) {
            clearTimeout(this.typingTimeout);
            this.typingTimeout = null;
        }

        if (this.isTyping) {
            this.isTyping = false;
            this.broadcastTyping(false);
        }
    }

    /**
     * Broadcast typing status
     */
    broadcastTyping(isTyping) {
        Echo.private(`conversation.${this.conversationId}`)
            .whisper('typing', {
                conversationId: this.conversationId,
                userId: window.Laravel.userId,
                userName: window.Laravel.userName,
                userAvatar: window.Laravel.userAvatar,
                isTyping: isTyping,
            });
    }

    /**
     * Toggle typing indicator UI
     */
    toggleTypingIndicator(event) {
        if (!this.typingIndicator) return;

        if (event.is_typing && event.user_id !== window.Laravel.userId) {
            this.typingIndicator.style.display = 'flex';
            const typingText = this.typingIndicator.querySelector('.typing-text');
            if (typingText) {
                typingText.textContent = `${event.user_name} is typing...`;
            }
            this.scrollToBottom();
        } else {
            this.typingIndicator.style.display = 'none';
        }
    }

    /**
     * Format timestamp like WhatsApp
     */
    formatWhatsAppTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);
        const messageDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        const hours = date.getHours();
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        const formattedHours = String(hours % 12 || 12).padStart(2, '0');
        const time = `${formattedHours}:${minutes} ${ampm}`;

        if (messageDate.getTime() === today.getTime()) {
            return time;
        } else if (messageDate.getTime() === yesterday.getTime()) {
            return 'Yesterday';
        } else {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }
    }

    /**
     * Append message to chat
     */
    appendMessage(event) {
        const isSent = event.sender_id === window.Laravel.userId;
        const messageClass = isSent ? 'sent' : 'received';
        const time = this.formatWhatsAppTime(event.created_at);

        console.log('Message time:', time, 'from date:', event.created_at);

        let messageContent = '';

        // Check if message has attachments
        if (event.message_type === 'file' && event.attachments && event.attachments[0]) {
            const attachment = event.attachments[0];
            const isImage = attachment.file_type && attachment.file_type.startsWith('image/');

            if (isImage) {
                messageContent = `
                    <div class="message-image">
                        <img src="${attachment.file_url}" alt="${attachment.file_name}" style="max-width: 300px; border-radius: 8px; cursor: pointer;" onclick="window.open(this.src)">
                    </div>
                `;
            } else {
                const fileIcon = this.getFileIcon(attachment.file_type);
                messageContent = `
                    <div class="message-file">
                        <i class="${fileIcon}"></i>
                        <div class="file-info">
                            <div class="file-name">${attachment.file_name}</div>
                            <div class="file-size">${this.formatFileSize(attachment.file_size)}</div>
                        </div>
                        <a href="${attachment.file_url}" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                `;
            }
        } else if (event.message_type === 'file') {
            messageContent = `
                <div class="message-file">
                    <i class="fas fa-file"></i>
                    <a href="${event.file_url}" download target="_blank">
                        ${event.file_name}
                    </a>
                    ${event.file_size ? `<span class="file-size">(${this.formatFileSize(event.file_size)})</span>` : ''}
                </div>
            `;
        } else if (event.message_type === 'image') {
            messageContent = `
                <div class="message-image">
                    <img src="${event.file_url}" alt="Image" class="img-fluid">
                </div>
            `;
        } else {
            messageContent = `<p class="message-text">${this.escapeHtml(event.message)}</p>`;
        }

        // Determine tick status for sent messages
        let tickStatus = '';
        if (isSent) {
            // Use is_read and is_delivered from the message data if available
            if (event.is_read) {
                tickStatus = 'read';
            } else if (event.is_delivered) {
                tickStatus = 'delivered';
            } else {
                tickStatus = 'sent';
            }
        }

        const messageHtml = `
            <div class="message ${messageClass}" data-message-id="${event.id}">
                ${!isSent ? `
                <div class="message-avatar">
                    <img src="${event.sender_avatar}" alt="${event.sender_name}">
                </div>
                ` : ''}
                <div class="message-content">
                    <div class="message-header">
                        ${!isSent ? `<span class="sender-name">${event.sender_name}</span>` : ''}
                        <span class="message-time">${time}</span>
                    </div>
                    ${messageContent}
                    ${isSent ? `
                    <div class="message-status" data-status="${tickStatus}">
                        ${this.getTickIcon(tickStatus)}
                    </div>
                    ` : ''}
                    <div class="message-actions">
                        <button class="btn-action" onclick="window.chatManager.replyToMessage(${event.id})" title="Reply">
                            <i class="fas fa-reply"></i>
                        </button>
                        ${isSent ? `
                        <button class="btn-action" onclick="window.chatManager.deleteMessage(${event.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;

        this.chatMessages.insertAdjacentHTML('beforeend', messageHtml);
    }

    /**
     * Get tick icon based on message status
     */
    getTickIcon(status) {
        switch (status) {
            case 'read':
                return '<i class="fi fi-rr-check read"></i><i class="fi fi-rr-check read"></i>';
            case 'delivered':
                return '<i class="fi fi-rr-check delivered"></i><i class="fi fi-rr-check delivered"></i>';
            case 'sent':
            default:
                return '<i class="fi fi-rr-check sent"></i>';
        }
    }

    /**
     * Mark all messages in conversation as delivered
     */
    async markConversationAsDelivered() {
        try {
            const response = await fetch(this.getMarkAsDeliveredUrl(), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    conversation_id: this.conversationId,
                    _token: window.Laravel.csrfToken,
                }),
            });

            const data = await response.json();
            if (data.success) {
                console.log('Messages marked as delivered:', data.message_ids);
                // Update ticks for all delivered messages
                this.updateMessageTicks(data.message_ids, 'delivered');
            }
        } catch (error) {
            console.error('Error marking messages as delivered:', error);
        }
    }

    /**
     * Mark specific message as read when visible
     */
    async markMessageAsRead(messageId) {
        try {
            const response = await fetch(this.getMessageReadUrl(), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    message_id: messageId,
                    _token: window.Laravel.csrfToken,
                }),
            });

            const data = await response.json();
            if (data.success) {
                this.updateMessageTick(messageId, 'read');
            }
        } catch (error) {
            console.error('Error marking message as read:', error);
        }
    }

    /**
     * Update message tick UI
     */
    updateMessageTick(messageId, status) {
        const messageElement = this.chatMessages.querySelector(`[data-message-id="${messageId}"]`);
        if (!messageElement) {
            console.log(`Message element not found for ID: ${messageId}`);
            return;
        }

        const statusElement = messageElement.querySelector('.message-status');
        if (!statusElement) {
            console.log(`Status element not found for message ID: ${messageId}`);
            return;
        }

        console.log(`Updating message ${messageId} tick to: ${status}`);
        statusElement.dataset.status = status;
        statusElement.innerHTML = this.getTickIcon(status);
    }

    /**
     * Update multiple message ticks
     */
    updateMessageTicks(messageIds, status) {
        console.log(`Updating ${messageIds.length} messages to status: ${status}`, messageIds);
        messageIds.forEach(messageId => {
            this.updateMessageTick(messageId, status);
        });
    }

    /**
     * Setup file upload button
     */
    setupFileUpload() {
        if (!this.attachFileBtn || !this.fileInput) return;

        this.attachFileBtn.addEventListener('click', () => {
            this.fileInput.click();
        });

        this.fileInput.addEventListener('change', () => {
            if (this.fileInput.files[0]) {
                this.messageForm.dispatchEvent(new Event('submit'));
            }
        });
    }

    /**
     * Setup emoji picker
     */
    setupEmojiPicker() {
        const emojiBtn = document.querySelector('.btn-emoji');
        if (!emojiBtn) return;

        emojiBtn.addEventListener('click', () => {
            // Simple emoji insertion - can be enhanced with a full emoji picker
            const emojis = ['😀', '😂', '😍', '👍', '❤️', '🎉', '👏', '🙏'];
            const randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];
            this.messageInput.value += randomEmoji;
            this.messageInput.focus();
        });
    }

    /**
     * Auto-resize textarea
     */
    autoResizeTextarea() {
        if (!this.messageInput) return;

        this.messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 150) + 'px';
        });
    }

    /**
     * Scroll to bottom of chat
     */
    scrollToBottom() {
        if (this.chatMessages) {
            this.chatMessages.scrollTop = this.chatMessages.scrollHeight;
        }
    }

    /**
     * Mark messages as read
     */
    async markAsRead() {
        try {
            await fetch(this.getMarkAsReadUrl(), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    conversation_id: this.conversationId,
                    _token: window.Laravel.csrfToken,
                }),
            });
        } catch (error) {
            console.error('Error marking messages as read:', error);
        }
    }

    /**
     * Delete message
     */
    async deleteMessage(messageId) {
        if (!confirm('Are you sure you want to delete this message?')) return;

        try {
            const response = await fetch(this.getDeleteMessageUrl(), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    message_id: messageId,
                    _token: window.Laravel.csrfToken,
                }),
            });

            const data = await response.json();

            if (data.success) {
                const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
                if (messageElement) {
                    messageElement.style.opacity = '0';
                    setTimeout(() => messageElement.remove(), 300);
                }
            }
        } catch (error) {
            console.error('Error deleting message:', error);
            this.showError('Failed to delete message');
        }
    }

    /**
     * Reply to message
     */
    replyToMessage(messageId) {
        const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
        const messageText = messageElement?.querySelector('.message-text')?.textContent || '';

        const replyPreview = document.getElementById('replyPreview');
        const replyToText = document.getElementById('replyToText');

        if (replyPreview && replyToText) {
            window.replyToMessageId = messageId;
            replyToText.textContent = messageText.substring(0, 50) + (messageText.length > 50 ? '...' : '');
            replyPreview.style.display = 'flex';
            this.messageInput.focus();
        }
    }

    /**
     * Play notification sound
     */
    playNotificationSound() {
        // Only play if not focused on the window
        if (document.hidden) {
            const audio = new Audio('/sounds/message.mp3');
            audio.play().catch(() => {}); // Silent fail if audio not available
        }
    }

    /**
     * Update title with unread count
     */
    updateTitleNotification() {
        if (document.hidden) {
            let count = parseInt(document.title.match(/\((\d+)\)/)?.[1] || 0) + 1;
            document.title = `(${count}) New Message`;
        }
    }

    /**
     * Show error message
     */
    showError(message) {
        alert(message);
    }

    /**
     * Escape HTML
     */
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    /**
     * Get file icon class based on mime type
     */
    getFileIcon(mimeType) {
        if (!mimeType) return 'fas fa-file';
        if (mimeType.startsWith('image/')) return 'fas fa-image';
        if (mimeType === 'application/pdf') return 'fas fa-file-pdf';
        if (mimeType.startsWith('text/')) return 'fas fa-file-alt';
        if (mimeType.includes('word')) return 'fas fa-file-word';
        if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'fas fa-file-excel';
        if (mimeType.includes('powerpoint')) return 'fas fa-file-powerpoint';
        return 'fas fa-file';
    }

    /**
     * Format file size
     */
    formatFileSize(bytes) {
        if (!bytes) return '';
        const units = ['B', 'KB', 'MB', 'GB'];
        let i = 0;
        while (bytes > 1024) {
            bytes /= 1024;
            i++;
        }
        return `${bytes.toFixed(1)} ${units[i]}`;
    }

    /**
     * Get send URL based on user role
     */
    getSendUrl() {
        return window.Laravel.userRole === 1
            ? '/nurse/chat/send'
            : '/healthcare-facilities/chat/send';
    }

    /**
     * Get upload URL
     */
    getUploadUrl() {
        return window.Laravel.userRole === 1
            ? '/nurse/chat/upload'
            : '/healthcare-facilities/chat/upload';
    }

    /**
     * Get mark as read URL
     */
    getMarkAsReadUrl() {
        return window.Laravel.userRole === 1
            ? '/nurse/chat/mark-as-read'
            : '/healthcare-facilities/chat/mark-as-read';
    }

    /**
     * Get mark as delivered URL
     */
    getMarkAsDeliveredUrl() {
        return window.Laravel.userRole === 1
            ? '/nurse/chat/mark-as-delivered'
            : '/healthcare-facilities/chat/mark-as-delivered';
    }

    /**
     * Get message read status update URL
     */
    getMessageReadUrl() {
        return window.Laravel.userRole === 1
            ? '/nurse/chat/message-read'
            : '/healthcare-facilities/chat/message-read';
    }

    /**
     * Get delete message URL
     */
    getDeleteMessageUrl() {
        return window.Laravel.userRole === 1
            ? '/nurse/chat/delete'
            : '/healthcare-facilities/chat/delete';
    }

    /**
     * Update online status
     */
    updateOnlineStatus(users) {
        const isOtherOnline = users.some(u => u.id == window.Laravel.otherParticipantId);
        this.showUserOnline(isOtherOnline);
    }

    /**
     * Show user online/offline
     */
    showUserOnline(isOnline) {
        const statusIcon = document.getElementById('status-icon');
        const statusText = document.getElementById('status-text');
        const statusContainer = document.getElementById('userStatusContainer');

        if (statusIcon && statusText) {
            if (isOnline) {
                statusIcon.style.color = '#28a745';
                statusText.textContent = 'Online';
                statusText.style.color = '#28a745';

                if (statusContainer) {
                    statusContainer.classList.remove('offline');
                    statusContainer.classList.add('online');
                    statusContainer.style.color = '#28a745';
                }
            } else {
                statusIcon.style.color = '#888';
                statusText.textContent = 'Offline';
                statusText.style.color = '#888';

                if (statusContainer) {
                    statusContainer.classList.remove('online');
                    statusContainer.classList.add('offline');
                    statusContainer.style.color = '#888';
                }
            }
            console.log('User status updated:', isOnline ? 'Online' : 'Offline');
        }
    }

    /**
     * Show notification toast
     */
    showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'status-notification';
        notification.textContent = message;
        notification.style.cssText = 'position: fixed; top: 20px; right: 20px; background: #28a745; color: white; padding: 10px 20px; border-radius: 5px; z-index: 9999; animation: slideIn 0.3s ease-out;';
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    /**
     * Show user offline
     */
    showUserOffline(user) {
        this.showUserOnline(false);
    }

    /**
     * Start heartbeat to keep connection alive
     */
    startHeartbeat() {
        const self = this;

        // Send initial heartbeat
        this.sendHeartbeat();

        // Send heartbeat every 30 seconds
        const heartbeatInterval = setInterval(() => {
            this.sendHeartbeat();
        }, 30000);

        // Send offline status when leaving page
        window.addEventListener('beforeunload', function() {
            self.sendOfflineStatus();
            clearInterval(heartbeatInterval);
        });
    }

    /**
     * Send heartbeat to mark user as online
     */
    sendHeartbeat() {
        const url = window.Laravel.userRole === 1
            ? '/nurse/chat/online-status'
            : '/healthcare-facilities/chat/online-status';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || window.Laravel.csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ is_online: true })
        }).catch(err => console.error('Heartbeat failed:', err));
    }

    /**
     * Send offline status
     */
    sendOfflineStatus() {
        const url = window.Laravel.userRole === 1
            ? '/nurse/chat/online-status'
            : '/healthcare-facilities/chat/online-status';

        navigator.sendBeacon(url, JSON.stringify({ is_online: false }));
    }
}

// Export for use in views
window.ChatManager = ChatManager;

// Auto-initialize if chat container exists
document.addEventListener('DOMContentLoaded', () => {
    const chatContainer = document.querySelector('.chat-container');
    if (chatContainer && window.Laravel?.conversationId) {
        window.chatManager = new ChatManager(window.Laravel.conversationId);
    }
});
