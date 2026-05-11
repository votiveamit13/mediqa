<ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.view-profile' ? 'active' : '' }}" href="{{ route('admin.view-profile', ['id' => $profileData->id ]) }}">
            <span>Basic Details</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.setting_availablity_view' ? 'active' : '' }}" href="{{ route('admin.setting_availablity_view', ['id' => $profileData->id ]) }}">
            <span>Setting & Availability</span>
        </a>
    </li>

    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.registration_licenses' ? 'active' : '' }}" href="{{ route('admin.registration_licenses', ['id' => $profileData->id ]) }}">
            <span>Registrations and Licences</span>
        </a>
    </li>
    
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.profession_view' ? 'active' : '' }}" href="{{ route('admin.profession_view', ['id' => $profileData->id ]) }}">
            <span>Profession</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.education_certification' ? 'active' : '' }}" href="{{ route('admin.education_certification', ['id' => $profileData->id ]) }}">
            <span>Education and Certifications</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.mandatory_training_view' ? 'active' : '' }}" href="{{ route('admin.mandatory_training_view', ['id' => $profileData->id ]) }}">
            <span>Mandatory Training and Continuing Education</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.experience_view' ? 'active' : '' }}" href="{{ route('admin.experience_view', ['id' => $profileData->id ]) }}">
            <span>Experience</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.view_references' ? 'active' : '' }}" href="{{ route('admin.view_references', ['id' => $profileData->id ]) }}">
            <span>References</span>
        </a>
    </li>
    
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.vaccination_view' ? 'active' : '' }}" href="{{ route('admin.vaccination_view', ['id' => $profileData->id ]) }}">
            <span>Vaccinations</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.checks_clearacnces' ? 'active' : '' }}" href="{{ route('admin.checks_clearacnces', ['id' => $profileData->id ]) }}">
            <span>Checks and Clearances</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.professional_membership' ? 'active' : '' }}" href="{{ route('admin.professional_membership', ['id' => $profileData->id ]) }}" role="tab">
            <span>Professional Memberships & Awards</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.language_skills' ? 'active' : '' }}" href="{{ route('admin.language_skills', ['id' => $profileData->id ]) }}">
            <span>Language Skills</span>
        </a>
    </li>
    
</ul>