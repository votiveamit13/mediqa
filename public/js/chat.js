/**
 * Chat System - Compiled Version for Production
 * MediQa Nurse-Healthcare Chat Application
 *
 * Note: This is a simplified version without ES6 modules.
 * For development, use resources/js/chat.js with Vite/Laravel Mix.
 */

(function() {
    'use strict';

    /**
     * Chat Manager Class
     */
    window.ChatManager = function(conversationId) {
        this.conversationId = conversationId;
        this.typingTimeout = null;
        this.isTyping = false;

        this.init();
    };

    window.ChatManager.prototype = {
        init: function() {
            this.setupElements();
            if (window.Echo) {
                this.listenForMessages();
                this.listenForTyping();
            }
            this.setupMessageForm();
            this.setupTypingDetection();
            this.setupFileUpload();
            this.autoResizeTextarea();
            this.scrollToBottom();
        },

        setupElements: function() {
            this.chatMessages = document.getElementById('chatMessages');
            this.messageForm = document.getElementById('messageForm');
            this.messageInput = document.getElementById('messageInput');
            this.sendBtn = document.getElementById('sendBtn');
            this.fileInput = document.getElementById('fileInput');
            this.attachFileBtn = document.getElementById('attachFileBtn');
            this.typingIndicator = document.getElementById('typingIndicator');
        },

        listenForMessages: function() {
            var self = this;
            Echo.private('conversation.' + this.conversationId)
                .listen('.message.sent', function(event) {
                    self.appendMessage(event);
                });
        },

        listenForTyping: function() {
            var self = this;
            Echo.join('conversation.' + this.conversationId + '.presence')
                .here(function(users) {
                    console.log('Users in conversation:', users);
                })
                .listen('.user.typing', function(event) {
                    self.toggleTypingIndicator(event);
                });
        },

        setupMessageForm: function() {
            var self = this;
            if (!this.messageForm) return;

            this.messageForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var message = self.messageInput.value.trim();
                if (!message && !self.fileInput.files[0]) return;

                if (self.fileInput.files[0]) {
                    self.uploadFile();
                } else {
                    self.sendMessage(message);
                }
            });
        },

        sendMessage: function(message) {
            var self = this;
            var formData = new FormData();
            formData.append('conversation_id', this.conversationId);
            formData.append('message', message);
            formData.append('_token', window.Laravel.csrfToken);

            fetch(this.getSendUrl(), {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    self.appendMessage({
                        ...data.message,
                        sender_id: data.message.sender.id,
                        sender_name: data.message.sender.name,
                        sender_avatar: data.message.sender.profile_img,
                    });
                    self.messageInput.value = '';
                    self.stopTyping();
                    self.scrollToBottom();
                }
            })
            .catch(function(error) {
                console.error('Error sending message:', error);
            });
        },

        uploadFile: function() {
            var self = this;
            var file = this.fileInput.files[0];
            if (!file || file.size > 10 * 1024 * 1024) return;

            var formData = new FormData();
            formData.append('conversation_id', this.conversationId);
            formData.append('file', file);
            formData.append('_token', window.Laravel.csrfToken);

            fetch(this.getUploadUrl(), {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    self.appendMessage({
                        ...data.message,
                        sender_id: data.message.sender.id,
                        sender_name: data.message.sender.name,
                        sender_avatar: data.message.sender.profile_img,
                    });
                    self.fileInput.value = '';
                    self.scrollToBottom();
                }
            })
            .catch(function(error) {
                console.error('Error uploading file:', error);
            });
        },

        setupTypingDetection: function() {
            var self = this;
            if (!this.messageInput) return;

            this.messageInput.addEventListener('input', function() {
                self.startTyping();
            });

            this.messageInput.addEventListener('blur', function() {
                self.stopTyping();
            });
        },

        startTyping: function() {
            var self = this;
            if (this.typingTimeout) clearTimeout(this.typingTimeout);

            if (!this.isTyping) {
                this.isTyping = true;
                this.broadcastTyping(true);
            }

            this.typingTimeout = setTimeout(function() {
                self.stopTyping();
            }, 2000);
        },

        stopTyping: function() {
            if (this.typingTimeout) {
                clearTimeout(this.typingTimeout);
                this.typingTimeout = null;
            }

            if (this.isTyping) {
                this.isTyping = false;
                this.broadcastTyping(false);
            }
        },

        broadcastTyping: function(isTyping) {
            if (window.Echo) {
                Echo.private('conversation.' + this.conversationId)
                    .whisper('typing', {
                        conversationId: this.conversationId,
                        userId: window.Laravel.userId,
                        userName: window.Laravel.userName,
                        isTyping: isTyping,
                    });
            }
        },

        toggleTypingIndicator: function(event) {
            if (!this.typingIndicator) return;

            if (event.is_typing && event.user_id !== window.Laravel.userId) {
                this.typingIndicator.style.display = 'flex';
                var typingText = this.typingIndicator.querySelector('.typing-text');
                if (typingText) {
                    typingText.textContent = event.user_name + ' is typing...';
                }
                this.scrollToBottom();
            } else {
                this.typingIndicator.style.display = 'none';
            }
        },

        appendMessage: function(event) {
            var isSent = event.sender_id === window.Laravel.userId;
            var messageClass = isSent ? 'sent' : 'received';
            var time = new Date(event.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            console.log('Appending message TIME :', event);

            var messageContent = '';
            if (event.message_type === 'file') {
                messageContent = '<div class="message-file"><i class="fas fa-file"></i> <a href="' + event.file_url + '" download target="_blank">' + event.file_name + '</a></div>';
            } else if (event.message_type === 'image') {
                messageContent = '<div class="message-image"><img src="' + event.file_url + '" alt="Image" class="img-fluid"></div>';
            } else {
                messageContent = '<p class="message-text">' + this.escapeHtml(event.message) + '</p>';
            }

            var messageHtml = '<div class="message ' + messageClass + '" data-message-id="' + event.id + '">' +
                (!isSent ? '<div class="message-avatar"><img src="' + event.sender_avatar + '" alt="' + event.sender_name + '"></div>' : '') +
                '<div class="message-content">' +
                '<div class="message-header">' +
                (!isSent ? '<span class="sender-name">' + event.sender_name + '</span>' : '') +
                '<span class="message-time">' + time + '</span>' +
                '</div>' +
                messageContent +
                (isSent ? '<div class="message-status"><i class="fas fa-check"></i></div>' : '') +
                '<div class="message-actions">' +
                '<button class="btn-action" onclick="window.chatManager.replyToMessage(' + event.id + ')"><i class="fas fa-reply"></i></button>' +
                (isSent ? '<button class="btn-action" onclick="window.chatManager.deleteMessage(' + event.id + ')"><i class="fas fa-trash"></i></button>' : '') +
                '</div>' +
                '</div></div>';

            this.chatMessages.insertAdjacentHTML('beforeend', messageHtml);
        },

        setupFileUpload: function() {
            var self = this;
            if (!this.attachFileBtn || !this.fileInput) return;

            this.attachFileBtn.addEventListener('click', function() {
                self.fileInput.click();
            });

            this.fileInput.addEventListener('change', function() {
                if (self.fileInput.files[0]) {
                    self.messageForm.dispatchEvent(new Event('submit'));
                }
            });
        },

        autoResizeTextarea: function() {
            if (!this.messageInput) return;

            this.messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 150) + 'px';
            });
        },

        scrollToBottom: function() {
            if (this.chatMessages) {
                this.chatMessages.scrollTop = this.chatMessages.scrollHeight;
            }
        },

        replyToMessage: function(messageId) {
            var messageElement = document.querySelector('[data-message-id="' + messageId + '"]');
            var messageText = messageElement ? messageElement.querySelector('.message-text').textContent : '';

            var replyPreview = document.getElementById('replyPreview');
            var replyToText = document.getElementById('replyToText');

            if (replyPreview && replyToText) {
                window.replyToMessageId = messageId;
                replyToText.textContent = messageText.substring(0, 50) + (messageText.length > 50 ? '...' : '');
                replyPreview.style.display = 'flex';
                this.messageInput.focus();
            }
        },

        deleteMessage: function(messageId) {
            var self = this;
            if (!confirm('Are you sure you want to delete this message?')) return;

            fetch(this.getDeleteMessageUrl(), {
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
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    var el = document.querySelector('[data-message-id="' + messageId + '"]');
                    if (el) {
                        el.style.opacity = '0';
                        setTimeout(function() { el.remove(); }, 300);
                    }
                }
            })
            .catch(function(error) {
                console.error('Error deleting message:', error);
            });
        },

        escapeHtml: function(text) {
            var div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },

        getSendUrl: function() {
            return window.Laravel.userRole === 1 ? '/nurse/chat/send' : '/healthcare/chat/send';
        },

        getUploadUrl: function() {
            return window.Laravel.userRole === 1 ? '/nurse/chat/upload' : '/healthcare/chat/upload';
        },

        getDeleteMessageUrl: function() {
            return window.Laravel.userRole === 1 ? '/nurse/chat/delete' : '/healthcare/chat/delete';
        }
    };

    // Auto-initialize
    document.addEventListener('DOMContentLoaded', function() {
        var chatContainer = document.querySelector('.chat-container');
        if (chatContainer && window.Laravel && window.Laravel.conversationId) {
            window.chatManager = new window.ChatManager(window.Laravel.conversationId);
        }
    });

})();
