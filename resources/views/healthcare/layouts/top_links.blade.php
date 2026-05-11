<style>
    .job-links{
        display:flex;
        gap:15px;
        padding:12px;
        background:#f5f5f5;
        border-radius:10px;
        margin-bottom:20px;
    }

    .job-link{
        padding:10px 18px;
        text-decoration:none;
        font-weight:600;
        border-radius:8px;
        background:white;
        color:#333;
        border:1px solid #ddd;
        transition:.2s;
    }

    .job-link:hover{
        background:#000;
        color:#fff;
    }

    .job-link.active{
        background:#000;
        color:#fff;
        border-color:#000;
    }
</style>
<div class="job-links">
    <a href="{{ route('medical-facilities.active_jobs') }}" class="job-link {{ request()->routeIs('medical-facilities.active_jobs') ? 'active' : '' }}">Active Jobs</a>
    <a href="{{ route('medical-facilities.draft_jobs') }}" class="job-link {{ request()->routeIs('medical-facilities.draft_jobs') ? 'active' : '' }}">Drafts</a>
    <a href="{{ route('medical-facilities.expired_jobs') }}" class="job-link {{ request()->routeIs('medical-facilities.expired_jobs') ? 'active' : '' }}">Expired/Closed</a>
</div>