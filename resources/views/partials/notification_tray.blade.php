{{--
  resources/views/partials/notification_tray.blade.php
  Drop-down notification tray — opens below the bell icon.
  Shows latest 7 notifications, "See all notifications" link at the bottom.
  Usage: @include('partials.notification_tray')
--}}

<div class="notif-wrapper" id="notif-wrapper">

  {{-- Bell button --}}
  <button class="btn btn-notify notif-bell-btn" id="notif-bell-btn"
          type="button" aria-label="Notifications" aria-expanded="false">
    <i class="fi fi-rr-bell"></i>
    @if($unreadMessagesCount > 0)
      <span class="notify-badge badge rounded-pill bg-danger notification-badge">
        {{ $unreadMessagesCount }}
      </span>
    @endif
  </button>

  {{-- Drop-down panel --}}
  <div class="notif-dropdown" id="notif-dropdown" role="dialog" aria-label="Notifications">

    {{-- Header --}}
    <div class="nd-header">
      <span class="nd-title">Notifications</span>
      <button class="nd-mark-all" id="nd-mark-all" type="button">Mark all as read</button>
    </div>

    {{-- Notification list --}}
    <ul class="nd-list" id="nd-list">
      <li class="nd-loading" id="nd-spinner">
        <span></span><span></span><span></span>
      </li>
    </ul>

    {{-- Empty state --}}
    <div class="nd-empty" id="nd-empty" style="display:none;">
      <i class="fi fi-rr-bell-slash"></i>
      <p>No notifications yet</p>
    </div>

    {{-- Footer --}}
    <div class="nd-footer">
      <a class="nd-see-all"
   href="{{ Auth::guard('nurse_middle')->check() 
        ? url('nurse/notifications-list') 
        : url('healthcare-facilities/notifications-list') }}">
        See all notifications
      </a>
    </div>

  </div>
</div>

<style>
.notif-wrapper {
  position: relative;
  display: inline-block;
}

.notif-dropdown {
  display: none;
  position: absolute;
  top: calc(100% + 10px);
  right: 0;
  width: 360px;
  max-width: 95vw;
  background: #fff;
  border: 1px solid rgba(0,0,0,.1);
  border-radius: 12px;
  box-shadow: 0 8px 30px rgba(0,0,0,.13);
  z-index: 1060;
  overflow: hidden;
}
.notif-dropdown.open {
  display: block;
  animation: ndFadeIn .15s ease-out;
}
@keyframes ndFadeIn {
  from { opacity:0; transform:translateY(-5px); }
  to   { opacity:1; transform:translateY(0); }
}
/* Arrow pointing up at the bell */
.notif-dropdown::before {
  content: '';
  position: absolute;
  top: -7px;
  right: 16px;
  width: 13px;
  height: 13px;
  background: #fff;
  border-left: 1px solid rgba(0,0,0,.1);
  border-top: 1px solid rgba(0,0,0,.1);
  transform: rotate(45deg);
}

/* Header */
.nd-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 16px 10px;
  border-bottom: 1px solid rgba(0,0,0,.07);
}
.nd-title {
  font-size: 15px;
  font-weight: 600;
  color: #111;
}
.nd-mark-all {
  font-size: 12px;
  color: #0d6efd;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
}
.nd-mark-all:hover { text-decoration: underline; }

/* List */
.nd-list {
  list-style: none;
  margin: 0;
  padding: 0;
  max-height: 440px;
  overflow-y: auto;
}

/* Item */
.nd-item {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 12px 16px;
  border-bottom: 1px solid rgba(0,0,0,.05);
  cursor: pointer;
  transition: background .12s;
  position: relative;
}
.nd-item:last-child { border-bottom: none; }
.nd-item:hover { background: #f8f9fa; }
.nd-item.unread { background: #f0f6ff; }
.nd-item.unread:hover { background: #e6f0ff; }
.nd-item.unread::after {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 3px;
  background: #0d6efd;
}

/* Icon */
.nd-icon {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  flex-shrink: 0;
  margin-top: 1px;
}
.nd-icon.job     { background: #dbeafe; color: #1d4ed8; }
.nd-icon.message { background: #dcfce7; color: #15803d; }
.nd-icon.system  { background: #fef9c3; color: #854d0e; }

/* Text */
.nd-content { flex: 1; min-width: 0; }
.nd-item-title {
  font-size: 13px;
  font-weight: 600;
  color: #111;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin-bottom: 2px;
  line-height: 1.3;
}
.nd-item-body {
  font-size: 12px;
  color: #555;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.nd-item-time {
  font-size: 11px;
  color: #999;
  margin-top: 3px;
}
.nd-item.unread .nd-item-time::before {
  content: '';
  display: inline-block;
  width: 6px; height: 6px;
  border-radius: 50%;
  background: #0d6efd;
  margin-right: 4px;
  vertical-align: middle;
  margin-bottom: 1px;
}

/* Loading dots */
.nd-loading {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 5px;
  padding: 26px 0;
}
.nd-loading span {
  width: 7px; height: 7px;
  border-radius: 50%;
  background: #0d6efd;
  opacity: .3;
  animation: ndPulse 1.1s ease-in-out infinite;
}
.nd-loading span:nth-child(2) { animation-delay: .18s; }
.nd-loading span:nth-child(3) { animation-delay: .36s; }
@keyframes ndPulse {
  0%,80%,100% { opacity:.2; transform:scale(.75); }
  40%         { opacity:1;  transform:scale(1); }
}

/* Empty */
.nd-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  padding: 32px 20px;
  color: #aaa;
  font-size: 13px;
}
.nd-empty i { font-size: 26px; }
.nd-empty p { margin: 0; }

/* Footer */
.nd-footer {
  border-top: 1px solid rgba(0,0,0,.07);
  text-align: center;
  padding: 11px 16px;
  background: #fafafa;
}
.nd-see-all {
  font-size: 13px;
  font-weight: 500;
  color: #0d6efd;
  text-decoration: none;
}
.nd-see-all:hover { text-decoration: underline; }

/* Flash on new live item */
@keyframes ndFlash {
  0%   { background: #cfe2ff; }
  100% { background: #f0f6ff; }
}
.nd-item.just-arrived { animation: ndFlash 1.4s ease-out forwards; }
</style>

<script>
(function () {

  var API_URL      = '{{ Auth::guard("nurse_middle")->check() ? url("nurse/notifications") : url("healthcare-facilities/notifications") }}';
  var READ_URL     = '{{ Auth::guard("nurse_middle")->check() ? url("nurse/notifications/read") : url("healthcare-facilities/notifications/read") }}';
  var READ_ALL_URL = '{{ Auth::guard("nurse_middle")->check() ? url("nurse/notifications/read-all") : url("healthcare-facilities/notifications/read-all") }}';
  var CSRF         = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '';

  var wrapper  = document.getElementById('notif-wrapper');
  var bell     = document.getElementById('notif-bell-btn');
  var dropdown = document.getElementById('notif-dropdown');
  var list     = document.getElementById('nd-list');
  var spinner  = document.getElementById('nd-spinner');
  var empty    = document.getElementById('nd-empty');
  var markAll  = document.getElementById('nd-mark-all');

  var localItems = [];
  var loaded     = false;
  var isLoading  = false;

  // ── Open / Close ──────────────────────────────────────────────────────────
  bell.addEventListener('click', function (e) {
    e.stopPropagation();
    if (dropdown.classList.contains('open')) {
      closeDropdown();
    } else {
      openDropdown();
    }
  });

  document.addEventListener('click', function (e) {
    if (!wrapper.contains(e.target)) closeDropdown();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeDropdown();
  });

  function openDropdown() {
    dropdown.classList.add('open');
    bell.setAttribute('aria-expanded', 'true');
    if (!loaded) fetchNotifications();
  }

  function closeDropdown() {
    dropdown.classList.remove('open');
    bell.setAttribute('aria-expanded', 'false');
  }

  // ── Fetch latest 7 ───────────────────────────────────────────────────────
  function fetchNotifications() {
    if (isLoading) return;
    isLoading = true;
    spinner.style.display = 'flex';
    empty.style.display   = 'none';
    clearItems();

    fetch(API_URL + '?page=1', {
      headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(function (r) { return r.json(); })
    .then(function (data) {
      isLoading = false;
      loaded    = true;
      spinner.style.display = 'none';
      if (!data.success) return;
      updateBadge(data.unread_count);
      localItems = (data.notifications || []).slice(0, 4);
      renderItems();
    })
    .catch(function () {
      isLoading = false;
      spinner.style.display = 'none';
    });
  }

  // ── Render ────────────────────────────────────────────────────────────────
  function renderItems() {
    clearItems();
    if (localItems.length === 0) { empty.style.display = 'flex'; return; }
    empty.style.display = 'none';
    var frag = document.createDocumentFragment();
    localItems.forEach(function (n) { frag.appendChild(buildItem(n)); });
    list.appendChild(frag);
  }

  function clearItems() {
    list.querySelectorAll('.nd-item').forEach(function (el) { el.remove(); });
  }

  var iconMap = {
    job:     '<i class="fi fi-rr-briefcase"></i>',
    message: '<i class="fi fi-rr-comment-alt"></i>',
    system:  '<i class="fi fi-rr-bell"></i>'
  };

  function buildItem(n) {
    var li = document.createElement('li');
    li.className = 'nd-item' + (n.is_read ? '' : ' unread');
    li.dataset.id = n.id;
    var t = n.type || 'system';
    li.innerHTML =
      '<div class="nd-icon ' + t + '">' + (iconMap[t] || iconMap.system) + '</div>' +
      '<div class="nd-content">' +
        '<div class="nd-item-title">' + esc(n.title) + '</div>' +
        '<div class="nd-item-body">'  + esc(n.body)  + '</div>' +
        '<div class="nd-item-time">'  + esc(n.created_at_human) + '</div>' +
      '</div>';
    li.addEventListener('click', function () {
      markRead(n.id, li);
      if (n.url && n.url !== '#') window.location.href = n.url;
      closeDropdown();
    });
    return li;
  }

  // ── Mark single read ──────────────────────────────────────────────────────
  function markRead(id, li) {
    if (!li.classList.contains('unread')) return;
    li.classList.remove('unread');
    fetch(READ_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
      body: JSON.stringify({ notification_id: id })
    })
    .then(function (r) { return r.json(); })
    .then(function (d) {
      if (d.success) {
        var item = localItems.find(function (n) { return n.id === id; });
        if (item) item.is_read = true;
        updateBadge(d.unread_count);
      }
    })
    .catch(function () {});
  }

  // ── Mark all read ─────────────────────────────────────────────────────────
  markAll.addEventListener('click', function () {
    fetch(READ_ALL_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(function (r) { return r.json(); })
    .then(function (d) {
      if (d.success) {
        localItems.forEach(function (n) { n.is_read = true; });
        list.querySelectorAll('.nd-item.unread').forEach(function (el) { el.classList.remove('unread'); });
        updateBadge(0);
      }
    })
    .catch(function () {});
  });

  // ── Badge ─────────────────────────────────────────────────────────────────
  function updateBadge(count) {
    var badges = document.querySelectorAll('.notification-badge');
    if (count > 0) {
      if (badges.length > 0) {
        badges.forEach(function (b) { b.textContent = count; b.style.display = 'inline-block'; });
      } else {
        var b = document.createElement('span');
        b.className = 'notify-badge badge rounded-pill bg-danger notification-badge';
        b.textContent = count;
        bell.appendChild(b);
      }
    } else {
      badges.forEach(function (b) { b.style.display = 'none'; });
    }
    document.querySelectorAll('.notification-count-text').forEach(function (el) {
      el.textContent = count + ' notifications';
    });
  }

  // ── Live prepend from Echo ────────────────────────────────────────────────
  window.prependLiveNotification = function (payload) {
    var n = {
      id:               payload.notification_id || ('live-' + Date.now()),
      type:             payload.type    || 'system',
      title:            payload.title   || (payload.facility_name ? 'New job from ' + payload.facility_name : 'New notification'),
      body:             payload.message || '',
      url:              payload.url     || '#',
      is_read:          false,
      created_at_human: 'just now'
    };
    localItems.unshift(n);
    if (localItems.length > 7) localItems.pop();
    if (loaded) {
      var li = buildItem(n);
      li.classList.add('just-arrived');
      var first = list.querySelector('.nd-item');
      if (first) { list.insertBefore(li, first); } else { list.appendChild(li); empty.style.display = 'none'; }
      var all = list.querySelectorAll('.nd-item');
      if (all.length > 7) all[all.length - 1].remove();
    }
    var cur = parseInt((document.querySelector('.notification-badge') || {}).textContent) || 0;
    updateBadge(cur + 1);
  };

  function esc(s) {
    if (!s) return '';
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

})();
</script>