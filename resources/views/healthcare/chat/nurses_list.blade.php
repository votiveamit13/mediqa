@extends('layouts.app')

@section('title', 'Browse Nurses')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1><i class="fas fa-user-nurse"></i> Browse Nurses</h1>
                <p>Start a conversation with qualified nurses</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <!-- Filters -->
            <div class="card filters-card">
                <div class="card-header">
                    <h5><i class="fas fa-filter"></i> Filters</h5>
                </div>
                <div class="card-body">
                    <form id="filterForm">
                        <div class="form-group">
                            <label>Specialty</label>
                            <select class="form-control" name="specialty">
                                <option value="">All Specialties</option>
                                <option value="RN">Registered Nurse</option>
                                <option value="EN">Enrolled Nurse</option>
                                <option value="NP">Nurse Practitioner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control" name="location" placeholder="City or State">
                        </div>
                        <div class="form-group">
                            <label>Availability</label>
                            <select class="form-control" name="availability">
                                <option value="">Any</option>
                                <option value="immediate">Immediate</option>
                                <option value="2weeks">Within 2 weeks</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Nurses List -->
            <div class="nurses-list">
                @forelse($nurses as $nurse)
                    <div class="nurse-card">
                        <div class="row no-gutters">
                            <div class="col-md-2">
                                <div class="nurse-avatar">
                                    <img src="{{ asset($nurse->profile_img ?? 'nurse/assets/imgs/nurse06.png') }}" alt="{{ $nurse->name }}">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="nurse-info">
                                    <h4>{{ $nurse->name }} {{ $nurse->lastname ?? '' }}</h4>
                                    <p class="nurse-specialty">
                                        <i class="fas fa-stethoscope"></i> 
                                        {{ $nurse->entry_level_nursing ?? 'Registered Nurse' }}
                                    </p>
                                    <p class="nurse-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $nurse->city ?? 'Location not specified' }}, {{ $nurse->state ?? '' }}
                                    </p>
                                    @if($nurse->bio)
                                        <p class="nurse-bio">{{ Str::limit($nurse->bio, 150) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="nurse-actions">
                                    <a href="{{ route('healthcare.chat.start', $nurse->id) }}" class="btn btn-primary btn-block">
                                        <i class="fas fa-comment"></i> Start Chat
                                    </a>
                                    <a href="/nurse/profile/{{ $nurse->id }}" class="btn btn-outline-secondary btn-block" target="_blank">
                                        <i class="fas fa-eye"></i> View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-results">
                        <i class="fas fa-user-slash"></i>
                        <h4>No nurses found</h4>
                        <p>Try adjusting your filters or search criteria</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($nurses->hasPages())
                <div class="pagination-wrapper mt-4">
                    {{ $nurses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.nurses-list {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.nurse-card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.nurse-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

.nurse-avatar img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
}

.nurse-info h4 {
    margin-bottom: 10px;
    color: #333;
}

.nurse-specialty,
.nurse-location {
    color: #666;
    margin-bottom: 5px;
}

.nurse-bio {
    color: #888;
    font-size: 0.9em;
}

.nurse-actions .btn {
    margin-bottom: 10px;
}

.filters-card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.no-results {
    text-align: center;
    padding: 60px 20px;
    color: #888;
}

.no-results i {
    font-size: 4em;
    margin-bottom: 20px;
}
</style>
@endpush
@endsection
