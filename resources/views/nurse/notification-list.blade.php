@extends('nurse.layouts.layout')

@section('content')
<main class="main">

<section class="pt-50 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-10 col-sm-12">
                <div class="d-flex align-items-center justify-content-between mb-30">
                    <div>
                        <h3 class="text-brand-1 mb-5">Notifications</h3>
                        <p class="font-sm text-muted">Stay updated with your latest alerts and messages</p>
                    </div>
                    <button class="btn btn-outline-secondary btn-sm" id="markAllReadBtn">
                        <i class="fi fi-rr-check-double me-1"></i> Mark all as read
                    </button>
                </div>

                <!-- {{-- Filters --}}
                <div class="d-flex gap-2 mb-20">
                    <button class="btn btn-brand-1 btn-sm notif-filter-btn active" data-filter="all">All</button>
                    <button class="btn btn-outline-secondary btn-sm notif-filter-btn" data-filter="job">Jobs</button>
                    <button class="btn btn-outline-secondary btn-sm notif-filter-btn" data-filter="message">Messages</button>
                </div> -->

                {{-- List --}}
                <div id="notification-list"></div>

                {{-- Loading --}}
                <div id="notif-loading" class="text-center py-4">Loading...</div>

                {{-- Empty --}}
                <div id="notif-empty" class="text-center py-5" style="display:none;">
                    <i class="fi fi-rr-bell-slash" style="font-size:3rem; color:#ccc;"></i>
                    <h5 class="text-muted mt-3">No notifications</h5>
                </div>

                {{-- Pagination --}}
                <div id="pagination" class="d-flex justify-content-center mt-30"></div>

            </div>
        </div>
    </div>
</section>

</main>
@endsection

@section('css')
<style>
.notif-list-item {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 10px;
    cursor: pointer;
}
.notif-list-item.unread {
    border-left: 4px solid #0d6efd;
    background: #f5f9ff;
}
.notif-list-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display:flex;
    align-items:center;
    justify-content:center;
}
.notif-list-icon.job { background:#e8fff0; color:#28a745; }
.notif-list-icon.message { background:#e8f4ff; color:#007bff; }

.pagination-btn {
    border: 1px solid #ddd;
    padding: 6px 12px;
    margin: 0 3px;
    cursor: pointer;
}
.pagination-btn.active {
    background: #0d6efd;
    color: #fff;
}
</style>
@endsection

@section('js')
<script>
const API_URL = "{{ url('nurse/notifications') }}";
const READ_URL = "{{ url('nurse/notifications/read') }}";
const READ_ALL_URL = "{{ url('nurse/notifications/read-all') }}";

let currentPage = 1;
let totalPages = 1;
let activeFilter = 'all';
let allItems = [];

function loadNotifications(page = 1) {
    currentPage = page;

    document.getElementById('notif-loading').style.display = 'block';

    fetch(API_URL + '?page=' + page)
        .then(res => res.json())
        .then(data => {

            document.getElementById('notif-loading').style.display = 'none';

            if (!data.success) return;

            allItems = data.notifications;

            // estimate total pages (simple logic)
            totalPages = Math.ceil(data.total / data.per_page);
currentPage = data.current_page;

            if (allItems.length === 0) {
                document.getElementById('notif-empty').style.display = 'block';
                return;
            }

            render();
            renderPagination();
        });
}

function render() {
    const container = document.getElementById('notification-list');
    container.innerHTML = '';

    let items = allItems;

    if (activeFilter !== 'all') {
        items = allItems.filter(n => n.type === activeFilter);
    }

    items.forEach(n => {
        const div = document.createElement('div');
        div.className = 'notif-list-item ' + (n.is_read ? '' : 'unread');

        div.innerHTML = `
            <div class="d-flex gap-3">
                <div class="notif-list-icon ${n.type}">
                    ${n.type === 'job' ? '💼' : '💬'}
                </div>
                <div>
                    <strong>${n.title}</strong>
                    <div>${n.body}</div>
                    <small>${n.created_at_human}</small>
                </div>
            </div>
        `;

        div.onclick = () => {
            markAsRead(n.id, div);
            if (n.url) window.location.href = n.url;
        };

        container.appendChild(div);
    });
}

function renderPagination() {
    const container = document.getElementById('pagination');
    container.innerHTML = '';

    if (totalPages <= 1) return;

    let start = Math.max(1, currentPage - 2);
    let end = Math.min(totalPages, currentPage + 2);

    if (currentPage > 1) {
        container.innerHTML += `<span class="pagination-btn" onclick="loadNotifications(${currentPage - 1})">Prev</span>`;
    }

    if (start > 1) {
        container.innerHTML += `<span class="pagination-btn" onclick="loadNotifications(1)">1</span>`;
        if (start > 2) container.innerHTML += `<span class="pagination-btn">...</span>`;
    }

    for (let i = start; i <= end; i++) {
        container.innerHTML += `
            <span class="pagination-btn ${i === currentPage ? 'active' : ''}" 
                onclick="loadNotifications(${i})">
                ${i}
            </span>
        `;
    }

    if (end < totalPages) {
        if (end < totalPages - 1) container.innerHTML += `<span class="pagination-btn">...</span>`;
        container.innerHTML += `<span class="pagination-btn" onclick="loadNotifications(${totalPages})">${totalPages}</span>`;
    }

    if (currentPage < totalPages) {
        container.innerHTML += `<span class="pagination-btn" onclick="loadNotifications(${currentPage + 1})">Next</span>`;
    }
}

function markAsRead(id, element) {
    fetch(READ_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ notification_id: id })
    }).then(() => {
        element.classList.remove('unread');
    });
}

document.getElementById('markAllReadBtn').addEventListener('click', () => {
    fetch(READ_ALL_URL, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        }
    }).then(() => loadNotifications(currentPage));
});

// FILTER
document.querySelectorAll('.notif-filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        document.querySelectorAll('.notif-filter-btn').forEach(b => b.classList.remove('btn-brand-1','active'));
        this.classList.add('btn-brand-1','active');

        activeFilter = this.dataset.filter;
        render();
    });
});

// INIT
loadNotifications(1);
</script>
@endsection