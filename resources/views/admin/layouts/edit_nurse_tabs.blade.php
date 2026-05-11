<ul class="nav nav-pills nav-fill mt-4 tabs-feat" role="tablist">
    <li class="nav-item" role="presentation">
        <a id="basic_details_link" class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ]) }}?tab=tab-1">
            <span>Basic Details</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.setting_availablity' ? 'active' : '' }}" href="{{ route('admin.setting_availablity', ['id' => $profileData->id ]) }}" href="{{ route('admin.setting_availablity', ['id' => $profileData->id ]) }}">
            <span>Setting & Availability</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.add_registration_licences' ? 'active' : '' }}" href="{{ route('admin.add_registration_licences', ['id' => $profileData->id ]) }}">
            <span>Registrations and Licences</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a id="profession_link" class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ]) }}?tab=tab-3">
            <span>Profession</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a id="edu_cert_link" class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ]) }}?tab=tab-4">
            <span>Education and Certifications</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.mandatory_training_edit' ? 'active' : '' }}" href="{{ route('admin.mandatory_training_edit', ['id' => $profileData->id ]) }}">
            <span>Mandatory Training and Continuing Education</span>
        </a>
    </li>
    
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.exptab' ? 'active' : '' }}" href="{{ route('admin.exptab', ['id' => $profileData->id]) }}">
            <span>Experience</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a id="references_link" class="nav-link" href="{{ route('admin.edit_nurse', ['id' => $profileData->id ]) }}?tab=tab-6">
            <span>References</span>
        </a>
    </li>
    
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.updateVaccinationRecord' ? 'active' : '' }}" href="{{ route('admin.updateVaccinationRecord', ['id' => $profileData->id ?? null, 'tab' => 'tab-8']) }}">
            <span>Vaccinations</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.updateWorkClreance' ? 'active' : '' }}" href="{{ route('admin.updateWorkClreance', ['id' => $profileData->id ?? null, 'tab' => 'tab-8']) }}" href="{{ route('admin.updateWorkClreance', ['id' => $profileData->id ?? null, 'tab' => 'tab-9']) }}">
            <span>Checks and Clearances</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.professional_membership_awards' ? 'active' : '' }}" href="{{ route('admin.professional_membership_awards', ['id' => $profileData->id]) }}" aria-selected="false"
            tabindex="-1">
            <span>Professional Memberships & Awards</span>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ Route::currentRouteName() == 'admin.editLanguageSkills' ? 'active' : '' }}" href="{{ route('admin.editLanguageSkills', ['id' => $profileData->id]) }}">
            <span>Language Skills</span>
        </a>
    </li>
</ul>