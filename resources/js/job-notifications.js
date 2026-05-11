/**
 * Real-time Job Notifications for Nurses
 * Listens for job.published events and displays notifications
 */

class JobNotificationManager {
    constructor() {
        this.notificationContainer = null;
        this.notifications = [];
        this.maxNotifications = 10;
        this.soundEnabled = true;

        this.init();
    }

    /**
     * Initialize job notification manager
     */
    init() {
        this.createNotificationContainer();
        this.listenForJobPublished();
        this.setupNotificationClickHandler();
        this.loadExistingNotifications();
    }

    /**
     * Create notification container in DOM
     */
    createNotificationContainer() {
        // Check if container already exists
        let container = document.getElementById('jobNotificationsContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'jobNotificationsContainer';
            container.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 400px;
            `;
            document.body.appendChild(container);
        }
        this.notificationContainer = container;
    }

    /**
     * Listen for job published events via Pusher
     */
    listenForJobPublished() {
        if (typeof window.Echo === 'undefined') {
            console.error('Laravel Echo not found. Make sure it is loaded before this script.');
            return;
        }

        const userId = window.Laravel?.userId;
        if (!userId) {
            console.error('User ID not found in window.Laravel');
            return;
        }

        console.log('Subscribing to job notifications for user:', userId);

        // Listen to user's private channel for job published events
        window.Echo.private(`user.${userId}`)
            .listen('.job.published', (event) => {
                console.log('New job published event received:', event);
                this.showJobNotification(event);
                this.addNotificationToList(event);
                this.playNotificationSound();
                this.updateNotificationBadge();
            });
    }

    /**
     * Show a toast notification for new job
     */
    showJobNotification(event) {
        const notification = document.createElement('div');
        notification.className = 'job-notification-toast';
        notification.dataset.jobId = event.job_id;
        notification.style.cssText = `
            background: white;
            border-left: 4px solid #28a745;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: slideInRight 0.3s ease-out;
        `;

        notification.innerHTML = `
            <div style="display: flex; align-items: start; gap: 12px;">
                <div style="flex-shrink: 0; width: 40px; height: 40px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-briefcase" style="color: white; font-size: 18px;"></i>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 600; color: #333; margin-bottom: 4px;">New Job Posted!</div>
                    <div style="font-size: 14px; color: #666; margin-bottom: 4px;">${this.escapeHtml(event.title)}</div>
                    <div style="font-size: 12px; color: #999;">
                        <i class="fas fa-hospital"></i> ${this.escapeHtml(event.facility_name)}<br>
                        <i class="fas fa-map-marker-alt"></i> ${this.escapeHtml(event.location)}
                    </div>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #999; font-size: 20px; padding: 0; line-height: 1;">
                    &times;
                </button>
            </div>
        `;

        // Click to view job details
        notification.addEventListener('click', (e) => {
            if (e.target.tagName !== 'BUTTON') {
                this.viewJobDetails(event.job_id);
            }
        });

        // Auto-hide after 8 seconds
        this.notificationContainer.insertBefore(notification, this.notificationContainer.firstChild);
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }, 8000);
    }

    /**
     * Add notification to internal list
     */
    addNotificationToList(event) {
        this.notifications.unshift({
            job_id: event.job_id,
            title: event.title,
            facility_name: event.facility_name,
            location: event.location,
            specialty: event.specialty,
            message: event.message,
            created_at: event.created_at,
            read: false
        });

        // Keep only last N notifications
        if (this.notifications.length > this.maxNotifications) {
            this.notifications = this.notifications.slice(0, this.maxNotifications);
        }

        // Save to localStorage
        this.saveNotifications();
    }

    /**
     * Load existing notifications from localStorage
     */
    loadExistingNotifications() {
        const saved = localStorage.getItem('jobNotifications');
        if (saved) {
            try {
                this.notifications = JSON.parse(saved);
                this.updateNotificationBadge();
            } catch (e) {
                console.error('Error loading notifications:', e);
            }
        }
    }

    /**
     * Save notifications to localStorage
     */
    saveNotifications() {
        localStorage.setItem('jobNotifications', JSON.stringify(this.notifications));
    }

    /**
     * Update notification badge count
     */
    updateNotificationBadge() {
        const unreadCount = this.notifications.filter(n => !n.read).length;
        
        // Update badge if it exists
        let badge = document.getElementById('jobNotificationBadge');
        if (!badge && unreadCount > 0) {
            badge = document.createElement('span');
            badge.id = 'jobNotificationBadge';
            badge.style.cssText = `
                position: fixed;
                top: 10px;
                right: 10px;
                background: #dc3545;
                color: white;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                font-weight: bold;
                z-index: 10000;
                cursor: pointer;
            `;
            document.body.appendChild(badge);
            
            badge.addEventListener('click', () => {
                this.showNotificationPanel();
            });
        }

        if (badge) {
            if (unreadCount > 0) {
                badge.textContent = unreadCount > 9 ? '9+' : unreadCount;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        }
    }

    /**
     * Mark notification as read
     */
    markAsRead(jobId) {
        const notification = this.notifications.find(n => n.job_id == jobId);
        if (notification) {
            notification.read = true;
            this.saveNotifications();
            this.updateNotificationBadge();
        }
    }

    /**
     * View job details
     */
    viewJobDetails(jobId) {
        this.markAsRead(jobId);
        
        // Navigate to job details page
        const jobUrl = window.Laravel?.baseUrl + '/nurse/jobs/' + jobId;
        window.open(jobUrl, '_blank');
    }

    /**
     * Show notification panel with all notifications
     */
    showNotificationPanel() {
        // Create panel if it doesn't exist
        let panel = document.getElementById('jobNotificationPanel');
        if (!panel) {
            panel = document.createElement('div');
            panel.id = 'jobNotificationPanel';
            panel.style.cssText = `
                position: fixed;
                top: 60px;
                right: 20px;
                width: 400px;
                max-height: 600px;
                background: white;
                box-shadow: 0 4px 20px rgba(0,0,0,0.2);
                border-radius: 12px;
                z-index: 10000;
                overflow: hidden;
                display: none;
            `;

            panel.innerHTML = `
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; font-weight: 600; font-size: 18px; display: flex; justify-content: space-between; align-items: center;">
                    <span><i class="fas fa-bell"></i> Job Notifications</span>
                    <button id="closeNotificationPanel" style="background: none; border: none; color: white; font-size: 24px; cursor: pointer;">&times;</button>
                </div>
                <div id="notificationList" style="max-height: 500px; overflow-y: auto;"></div>
                <div style="padding: 12px; text-align: center; border-top: 1px solid #eee;">
                    <button id="markAllAsRead" style="background: #28a745; color: white; border: none; padding: 8px 20px; border-radius: 6px; cursor: pointer;">Mark All as Read</button>
                </div>
            `;

            document.body.appendChild(panel);

            // Event listeners
            document.getElementById('closeNotificationPanel').addEventListener('click', () => {
                panel.style.display = 'none';
            });

            document.getElementById('markAllAsRead').addEventListener('click', () => {
                this.markAllAsRead();
            });
        }

        // Populate notifications
        const list = document.getElementById('notificationList');
        if (this.notifications.length === 0) {
            list.innerHTML = '<div style="padding: 40px; text-align: center; color: #999;"><i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 12px;"></i><p>No notifications yet</p></div>';
        } else {
            list.innerHTML = this.notifications.map(n => `
                <div class="notification-item" data-job-id="${n.job_id}" style="padding: 16px; border-bottom: 1px solid #eee; cursor: pointer; ${n.read ? '' : 'background: #f8f9fa;'}">
                    <div style="display: flex; gap: 12px; align-items: start;">
                        <div style="flex-shrink: 0; width: 36px; height: 36px; background: ${n.read ? '#e9ecef' : '#28a745'}; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-briefcase" style="color: ${n.read ? '#999' : 'white'}; font-size: 16px;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: ${n.read ? '400' : '600'}; color: #333; margin-bottom: 4px;">${this.escapeHtml(n.title)}</div>
                            <div style="font-size: 13px; color: #666;">
                                <i class="fas fa-hospital"></i> ${this.escapeHtml(n.facility_name)} | 
                                <i class="fas fa-map-marker-alt"></i> ${this.escapeHtml(n.location)}
                            </div>
                            <div style="font-size: 11px; color: #999; margin-top: 4px;">${this.formatTime(n.created_at)}</div>
                        </div>
                        ${!n.read ? '<div style="width: 10px; height: 10px; background: #28a745; border-radius: 50%; flex-shrink: 0;"></div>' : ''}
                    </div>
                </div>
            `).join('');

            // Add click handlers
            list.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', () => {
                    const jobId = item.dataset.jobId;
                    this.viewJobDetails(jobId);
                });
            });
        }

        panel.style.display = 'block';
    }

    /**
     * Mark all notifications as read
     */
    markAllAsRead() {
        this.notifications.forEach(n => n.read = true);
        this.saveNotifications();
        this.updateNotificationBadge();
        this.showNotificationPanel(); // Refresh panel
    }

    /**
     * Play notification sound
     */
    playNotificationSound() {
        if (!this.soundEnabled || !document.hidden) return;

        try {
            const audio = new Audio('/sounds/notification.mp3');
            audio.play().catch(() => {});
        } catch (e) {
            // Silent fail if audio not available
        }
    }

    /**
     * Setup notification click handler
     */
    setupNotificationClickHandler() {
        // Already handled in showJobNotification
    }

    /**
     * Escape HTML to prevent XSS
     */
    escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    /**
     * Format time relative to now
     */
    formatTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMs / 3600000);
        const diffDays = Math.floor(diffMs / 86400000);

        if (diffMins < 1) return 'Just now';
        if (diffMins < 60) return `${diffMins}m ago`;
        if (diffHours < 24) return `${diffHours}h ago`;
        if (diffDays < 7) return `${diffDays}d ago`;
        
        return date.toLocaleDateString();
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize for nurse users
    if (window.Laravel?.userRole === 'nurse' || window.Laravel?.isNurse) {
        console.log('Initializing Job Notification Manager...');
        window.jobNotificationManager = new JobNotificationManager();
    }
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }

    .notification-item:hover {
        background: #f0f0f0 !important;
    }
`;
document.head.appendChild(style);

// Export for use in other scripts
window.JobNotificationManager = JobNotificationManager;
