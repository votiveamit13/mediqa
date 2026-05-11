<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\nurse\HomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\medical_facilities\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|ererer
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ===========
// User Route
// ===========
Route::get('/clear-route-cache', function () {
  Artisan::call('route:clear');
  Artisan::call('config:clear');
  Artisan::call('cache:clear'); // optional, also clears application cache
  Artisan::call('view:clear');
  return "Route cache cleared!";
});
Route::post('/fetch-provinces', 'App\Http\Controllers\HomeController@fetchProvinces')->name('fetch-provinces');
Route::get('/', 'App\Http\Controllers\nurse\HomeController@index_main')->name('home_main');
Route::get('/term-and-condition', 'App\Http\Controllers\nurse\HomeController@term_and_condition')->name('term-and-condition');
Route::get('/contact', 'App\Http\Controllers\nurse\HomeController@contact')->name('contact');
Route::get('/about', 'App\Http\Controllers\nurse\HomeController@about')->name('about');
Route::get('/privacy', 'App\Http\Controllers\nurse\HomeController@privacy')->name('privacy');
Route::post('/save-contact', 'App\Http\Controllers\HomeController@saveContact')->name('save-contact');
Route::post('/getNurseTypeJobs', 'App\Http\Controllers\HomeController@getNurseTypeJobs')->name('getNurseTypeJobs');
Route::get('/nurseCareHome', 'App\Http\Controllers\HomeController@nurseCareHome')->name('nurseCareHome');
Route::post('/getSubSpecialties', 'App\Http\Controllers\HomeController@getSubSpecialties')->name('getSubSpecialties');
Route::post('/getNursepractitionorSpecialities', 'App\Http\Controllers\HomeController@getNurseSpecialties')->name('getNursepractitionorSpecialities');
Route::post('/getsurgicalSpeciality', 'App\Http\Controllers\HomeController@getsurgicalSpeciality')->name('getsurgicalSpeciality');
Route::post('/getsurgicalSubSpeciality', 'App\Http\Controllers\HomeController@getsurgicalSubSpeciality')->name('getsurgicalSubSpeciality');

Route::prefix('healthcare-facilities')->name('medical-facilities.')->namespace('App\Http\Controllers\medical_facilities')->group(function () {
  Route::get('/', 'HomeController@index_main')->name('medical_facilities_home_main');
  Route::get('/medical-facilities-registraion', 'HomeController@registraion')->name('medical-facilities-registraion');
  Route::post('/healthcareRegistration', 'HomeController@healthcareRegistration')->name('healthcareRegistration');
  Route::get('/email-verification-pending', 'HomeController@emailVerificationPending')->name('email-verification-pending');
  Route::get('/accept_invitation', 'HomeController@accept_invitation')->name('accept_invitation');
  Route::get('/acceptInvitation', 'SettingsController@accept_invitation')->name('acceptInvitation');
  Route::get('/profile-under-reviewed', 'HomeController@profileUnderReviewed')->name('profile-under-reviewed');
  Route::get('/login', 'HomeController@login')->name('login');
  Route::post('/userloginAction', 'HomeController@userloginAction')->name('userloginAction');
  Route::get('/logout', 'HomeController@logout')->name('logout');
  Route::get('/getWorkplaceData', 'JobPostingController@getWorkplaceData')->name('getWorkplaceData');
  Route::get('/getSubWorkplaceData', 'JobPostingController@getSubWorkplaceData')->name('getSubWorkplaceData');
  Route::get('/getMandatoryCourses', 'JobPostingController@getMandatoryCourses')->name('getMandatoryCourses');
  Route::get('/getEmpData', 'JobPostingController@getEmpData')->name('getEmpData');
  Route::get('/getStates', 'JobPostingController@getStates')->name('getStates');
  Route::get('/getCities', 'JobPostingController@getCities')->name('getCities');
  Route::get('/getCitiesLat', 'JobPostingController@getCitiesLat')->name('getCitiesLat');
  Route::get('/getLanguagesData', 'JobPostingController@getLanguagesData')->name('getLanguagesData');
  Route::get('/getStatesLat', 'FindNurseController@getCities')->name('getStatesLat');

  Route::get('/getAccreditationsData', 'HomeController@getAccreditationsData')->name('getAccreditationsData');
  Route::get('/email-verification/{token}', 'HomeController@email_verification')->name('email-verification');
  Route::get('/profile-under-reviewed', 'HomeController@profileUnderReviewed')->name('profile-under-reviewed');

  Route::middleware('healthcare_facilities')->group(function () {
    Route::get('/my-profile', 'HomeController@manage_profile')->name('my-profile');
    Route::get('/users', 'SettingsController@index')->name('users');
    Route::get('/invite_users', 'SettingsController@invite_users')->name('invite_users');
    Route::get('/find-nurse', 'FindNurseController@index')->name('job.find_nurse');
    Route::post('/getNurseSorting', 'FindNurseController@getNurseSorting')->name('job.getNurseSorting');
    Route::post('remove-filter/{id}', 'FindNurseController@removeFilter');
        
    Route::post('/hFaddSavedSearches', 'FindNurseController@hFaddSavedSearches')->name('hFaddSavedSearches');
    Route::post('/check-search-name', 'FindNurseController@checkName')->name('checkName');
    Route::post('/duplicateSearch', 'FindNurseController@duplicateSearch')->name('duplicateSearch');
    Route::post('/deleteSearchJobsData', 'FindNurseController@deleteSearchJobsData')->name('deleteSearchJobsData');
    Route::post('/deleteMultipleSearches', 'FindNurseController@deleteMultipleSearches')->name('deleteMultipleSearches');

    Route::get('/nurseType_list', 'FindNurseController@nurseType_list')->name('nurseType_list');
    Route::get('/nurseType-child/{parentId?}', 'FindNurseController@getChildnurseType')->name('nurseType-child');
    Route::get('/speciality_list', 'FindNurseController@speciality_list')->name('speciality_list');
    Route::get('/speciality-child/{parentId?}', 'FindNurseController@getChildSpeciality')->name('speciality-child');
    Route::get('/shiftType_list', 'FindNurseController@shiftType_list')->name('shiftType_list');
    Route::get('/shiftType-child/{parentId?}', 'FindNurseController@getChildshiftType')->name('shiftType-child');
    Route::get('/language_list', 'FindNurseController@language_list')->name('language_list');
    Route::get('/language-child/{parentId?}', 'FindNurseController@getChildlanguage')->name('language-child');

    Route::get('/work-environment-child/{parentId?}', 'FindNurseController@getChildWorkEnvironment')->name('work-environment-child');
    Route::get('/work_environment_list', 'FindNurseController@work_environment_list')->name('work_environment_list');

    Route::get('/employeement_type_list', 'FindNurseController@employeement_type_list')->name('employeement_type_list');
    Route::get('/employment-type-child/{parentId?}', 'FindNurseController@getEmployeementType')->name('employment-type-child');


    Route::get('/certification_list', 'FindNurseController@certification_list')->name('certification_list');
    Route::get('/certification-type-child/{parentId?}', 'FindNurseController@getCertificationType')->name('certification-type-child');
    Route::get('/international_hiring', 'FindNurseController@international_hiring')->name('international_hiring');
    Route::get('/degree_list', 'FindNurseController@degree_list')->name('degree_list');

    Route::get('/nurse_type_edit', 'FindNurseController@nurse_type_edit')->name('nurse_type_edit');
    Route::post('/apply_saved_search', 'FindNurseController@apply_saved_search')->name('apply_saved_search');

    Route::get('/employment_type_edit', 'FindNurseController@employment_type_edit')->name('employment_type_edit');
    Route::get('/shift_type_edit', 'FindNurseController@shift_type_edit')->name('shift_type_edit');
    
    Route::get('/language_edit', 'FindNurseController@language_edit')->name('language_edit');
    Route::get('/commonModalEdit', 'FindNurseController@commonModalEdit')->name('commonModalEdit');

    Route::get('/speciality_edit', 'FindNurseController@speciality_edit')->name('speciality_edit');

    Route::post('/apply_job_criteria', 'FindNurseController@apply_job_criteria')->name('apply_job_criteria');

    Route::get('/modal_invite_apply', 'FindNurseController@modal_invite_apply')->name('modal_invite_apply');
    Route::post('/apply_invite_form', 'FindNurseController@apply_invite_form')->name('apply_invite_form');
    Route::post('/apply_invite_message', 'FindNurseController@apply_invite_message')->name('apply_invite_message');

    Route::get('/modal_invite_interview', 'FindNurseController@modal_invite_interview')->name('modal_invite_interview');
    Route::post('/interview_invite_form', 'FindNurseController@interview_invite_form')->name('interview_invite_form');
    Route::post('/interview_invite_message', 'FindNurseController@interview_invite_message')->name('interview_invite_message');

    Route::post('/get_saved_search_filters', 'FindNurseController@get_saved_search_filters')->name('get_saved_search_filters');
    
    Route::get('/work_environment_edit', 'FindNurseController@work_environment_edit')->name('work_environment_edit');
    Route::get('/certification_edit', 'FindNurseController@certification_edit')->name('certification_edit');
    Route::post('/stripe/webhook', [StripeController::class, 'webhook']);
    Route::post('/inviteUser', 'SettingsController@inviteUser')->name('inviteUser');
    Route::get('/compliance_security', 'SettingsController@compliance_security')->name('compliance_security');
    Route::get('/deactivateUser', 'SettingsController@deactivate_user')->name('deactivateUser');
    Route::get('/deleteUser', 'SettingsController@delete_user')->name('deleteUser');
    Route::get('/billing', 'SettingsController@billing')->name('billing');
    Route::get('/notification', 'SettingsController@notification')->name('notification');
    Route::post('/notification_switch', 'SettingsController@notification_switch')->name('notification_switch');
    Route::get('/payment_page/{product_id}', 'SettingsController@payment_page')->name('payment_page');
    Route::post('/payment/process', 'SettingsController@process')->name('process');
    Route::get('/subscribe/{price_id}', 'SettingsController@subscribe')->name('subscribe');
    Route::get('/payment-success', 'SettingsController@success')->name('payment.success');
    Route::get('/payment-cancel', 'SettingsController@cancel')->name('payment.cancel');
    Route::get('/invoices', 'SettingsController@invoices')->name('invoices');
    Route::get('/invoice/download/{id}', 'SettingsController@downloadInvoice')->name('invoice.download');
    Route::get('/compliance_security', 'SettingsController@compliance_security')->name('compliance_security');
    Route::get('/support', 'SettingsController@support')->name('support');
    Route::get('/job_posting', 'JobPostingController@job_posting')->name('job_posting');
    Route::get('/contract_pay', 'JobPostingController@contract_pay')->name('contract_pay');
    Route::post('/updateContractPay', 'JobPostingController@updateContractPay')->name('updateContractPay');
    Route::get('/requirements', 'JobPostingController@requirements')->name('requirements');
    Route::post('/updateJobRequirements', 'JobPostingController@updateJobRequirements')->name('updateJobRequirements');
    Route::post('/updateBasicJobs', 'JobPostingController@updateBasicJobs')->name('updateBasicJobs');
    Route::get('/change_password', 'JobPostingController@change_password')->name('change_password');

    Route::get('/shift_scheduling', 'JobPostingController@shift_scheduling')->name('shift_scheduling');
    Route::post('/updateShiftScheduling', 'JobPostingController@updateShiftScheduling')->name('updateShiftScheduling');
    Route::get('/job_benefits', 'JobPostingController@job_benefits')->name('job_benefits');
    Route::post('/updateBenefitsPreferences', 'JobPostingController@updateBenefitsPreferences')->name('updateBenefitsPreferences');
    Route::get('/location_work_modal', 'JobPostingController@location_work_modal')->name('location_work_modal');
    Route::post('/updateLocationModel', 'JobPostingController@updateLocationModel')->name('updateLocationModel');
    Route::get('/job_description', 'JobPostingController@job_description')->name('job_description');
    Route::post('/updateJobDescription', 'JobPostingController@updateJobDescription')->name('updateJobDescription');
    Route::get('/visiblity_settings', 'JobPostingController@visiblity_settings')->name('visiblity_settings');
    Route::post('/updateVisiblitySettings', 'JobPostingController@updateVisiblitySettings')->name('updateVisiblitySettings');
    Route::get('/review_publish', 'JobPostingController@reviewPublish')->name('reviewPublish');
    Route::post('/saveDraft', 'JobPostingController@saveDraft')->name('saveDraft');
    Route::get('/active_jobs', 'JobPostingController@active_jobs')->name('active_jobs');
    Route::get('/draft_jobs', 'JobPostingController@draft_jobs')->name('draft_jobs');
    Route::post('/closeExpireJobs', 'JobPostingController@close_expire_jobs')->name('closeExpireJobs');
    Route::get('/expired_jobs', 'JobPostingController@expired_jobs')->name('expired_jobs');
    Route::post('/delete_jobs', 'JobPostingController@delete_jobs')->name('deleteJobs');
    Route::post('/publishJobs', 'JobPostingController@publish_jobs')->name('publishJobs');
    Route::post('/duplicateJobs', 'JobPostingController@duplicateJobs')->name('duplicateJobs');
    Route::get('/job_details/{job_id}', 'JobPostingController@job_details')->name('job_details');
    Route::post('/uploadJobImgs', 'JobPostingController@uploadJobImgs')->name('uploadJobImgs');
    Route::get('/nurse_applicants', 'JobPostingController@nurse_applicants')->name('nurse_applicants');
    Route::post('/change_application_status', 'JobPostingController@change_application_status')->name('change_application_status');
    Route::post('/updateProfile', 'HomeController@updateProfile')->name('updateProfile');
    // notification 
    Route::get('/notifications', 'NotificationController@getNotifications')->name('notifications.index');
    Route::post('/notifications/read', 'NotificationController@markAsRead')->name('notifications.read');
    Route::post('/notifications/read-all', 'NotificationController@markAllRead')->name('notifications.readAll');
    Route::get('/notifications-list', 'NotificationController@notificationPage')->name('notifications.page');
  });
});

Route::prefix('agencies')->name('agencies.')->namespace('App\Http\Controllers\agencies')->group(function () {
  Route::get('/', 'HomeController@index_main')->name('agencies_home_main');
  Route::get('/agencies-registraion', 'HomeController@registraion')->name('agencies-registraion');
  Route::get('/login', 'HomeController@login')->name('login');

  Route::post('/agenciesRegistration', 'HomeController@agenciesRegistration')->name('agenciesRegistration');
  Route::get('/email-verification-pending', 'HomeController@emailVerificationPending')->name('email-verification-pending');
  Route::get('/profile-under-reviewed', 'HomeController@profileUnderReviewed')->name('profile-under-reviewed');
  Route::post('/userloginAction', 'HomeController@userloginAction')->name('userloginAction');
  Route::get('/logout', 'HomeController@logout')->name('logout');
  Route::middleware('agencies')->group(function () {
    Route::get('/my-profile', 'HomeController@manage_profile')->name('my-profile');
  });
});

Route::prefix('individuals')->name('individuals.')->namespace('App\Http\Controllers\individuals')->group(function () {
  // Route::get('/', 'HomeController@index_main')->name('agencies_home_main');
  Route::get('/individuals_registraion', 'HomeController@registraion')->name('individuals_registraion');
  Route::get('/login', 'HomeController@login')->name('login');

  //Route::middleware('nurse_middle')->group(function () {});
});
Route::prefix('cpd_providers')->name('cpd_providers.')->namespace('App\Http\Controllers\cpd_providers')->group(function () {
  // Route::get('/', 'HomeController@index_main')->name('agencies_home_main');
  Route::get('/cpd_providers-registraion', 'HomeController@registraion')->name('cpd_providers-registraion');
  Route::get('/login', 'HomeController@login')->name('login');

  //Route::middleware('nurse_middle')->group(function () {});
});

Route::prefix('nurse')->name('nurse.')->namespace('App\Http\Controllers\nurse')->group(function () {
  Route::get('/getNurseDatas', 'HomeController@getNurseType')->name('getNurseType');
  Route::get('getSpecialityDatas1', 'HomeController@getSpecialityDatas')->name('getSpecialityDatas1');
  Route::get('/forgot-password', 'HomeController@forgotPassword')->name('forgot-password');
  Route::post('/forgot-password', 'HomeController@SendResetPasswordLink')->name('send-reset-password-link');
  Route::post('/addnewsletter', 'HomeController@addnewsletters')->name('addnewsletter');
  Route::post('/contact_us_data', 'HomeController@contact_us_data')->name('contact_us_data');

  Route::get('/reset-password/{token}/{lp}', 'HomeController@ResetPassword')->name('reset-password');
  Route::post('/reset-password', 'HomeController@UpdatePassword')->name('update-password');

  Route::post('/userloginAction', 'HomeController@userloginAction')->name('userloginAction');
  Route::post('/mail-exist', 'HomeController@mail_exist')->name('mail-exist');

  Route::get('/fetch-subspecialty', 'HomeController@fetchSubspecialty')->name('fetch-subspecialty');
  Route::get('/logout', 'HomeController@logout')->name('logout');
  Route::get('/login', 'HomeController@login')->name('login');

  Route::get('/', 'HomeController@index')->name('home');

  Route::get('/nurse-register', 'HomeController@nurse_register')->name('nurse-register');
  Route::post('/fetch-ahpra-details', 'AhpraLookupsController@getAhpraDetails')->name('getAhpraDetails');
  Route::get('/email-verification-pending', 'HomeController@emailVerificationPending')->name('email-verification-pending');
  Route::get('/resent-verification', 'HomeController@resentVerification')->name('resent-verification-link');
  Route::get('/email-verification/{token}', 'HomeController@email_verification')->name('email-verification');
  Route::post('/do-nurse-register', 'HomeController@do_nurse_register')->name('do-nurse-register');
  Route::get('/profile-under-reviewed', 'HomeController@profileUnderReviewed')->name('profile-under-reviewed');
  Route::middleware('nurse_middle')->group(function () {
    Route::get('/my-profile', 'HomeController@manage_profile')->name('my-profile');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::post('/filter-jobs', 'HomeController@filterJobs')->name('filter.jobs');
    Route::post('/jobs-like', 'HomeController@like_Jobs')->name('jobs.like');
    Route::get('/getEducationCourses', 'HomeController@getEducationCourses')->name('getEducationCourses');
    Route::get('/getEducationCoursesName', 'HomeController@getEducationCoursesName')->name('getEducationCoursesName');
    Route::post('/uploadEduEvidenceImgs', 'HomeController@uploadEduEvidenceImgs')->name('uploadEduEvidenceImgs');
    Route::post('/deleteEduEvidenceImg', 'HomeController@deleteEduEvidenceImg')->name('deleteEduEvidenceImg');
    Route::get('/dashboard1', 'HomeController@dashboard1')->name('dashboard1');
    Route::post('/changepassword', 'HomeController@changepassword')->name('changepassword');
    Route::any('/updateProfile', 'HomeController@updateProfile')->name('updateProfile');
    Route::post('/user-upload-image', 'HomeController@upload_profile_image')->name('user-upload-image');
    Route::post('/change_password', 'HomeController@change_password')->name('change_password');
    Route::post('/update-profession', 'HomeController@update_profession')->name('update-profession');
    Route::post('/update-profession-user-ahpra_numberI', 'HomeController@update_profession_ahpra_numberI')->name('update-profession-user-ahpra_numberI');
    Route::post('/user/active-country', [HomeController::class, 'updateActiveCountry'])->name('active-country');
    Route::post('/upload-registration-evidence', 'HomeController@uploadRegistrationEvidence')->name('nurse.uploadRegistrationEvidenceI');
    Route::post('/remove-registration-evidence', 'HomeController@removeRegistrationEvidence')->name('nurse.removeRegistrationEvidence');
    Route::post('/remove-registration-country', 'HomeController@remove_registration_country')->name('nurse.remove-registration-country');
    Route::post('/remove-qualification-country', 'HomeController@remove_qualification_country')->name('nurse.remove-qualification-country');
    // Route::post('/nurse/save-registration-country', function (Request $request) {
    //   auth('nurse_middle')->user()->update([
    //     'active_country' => $request->country_id,
    //     'country' => $request->country_id,
    //     'country_code' => $request->country_code,
    //   ]);

    //   return response()->json(['success' => true]);
    // })->name('saveRegistrationCountry');
    Route::post('/save-registration-country', 'HomeController@save_registration_country')->name('saveRegistrationCountry');
    Route::post('/update-profession-user-emergency', 'HomeController@update_emergency')->name('update-profession-user-emergency');
    Route::post('/update-profession-profile-setting', 'HomeController@update_profession_profile_setting')->name('update-profession-profile-setting');
    Route::post('/updateProfession', 'HomeController@updateProfession')->name('updateProfession');
    Route::post('/updateEducation', 'HomeController@updateEducation')->name('updateEducation');
    Route::post('/updateExperience', 'HomeController@updateExperience')->name('updateExperience');
    Route::post('/uploadExpImgs', 'HomeController@uploadExpImgs')->name('uploadExpImgs');
    Route::get('/getEmployeePositions', 'HomeController@getEmployeePositions')->name('getEmployeePositions');
    Route::post('/uploadAnotherImgs_cert', 'HomeController@uploadAnotherImgs_cert')->name('uploadAnotherImgs_cert');
    Route::get('/getWorkplaceData', 'HomeController@getWorkplaceData')->name('getWorkplaceData');
    Route::get('/getSubWorkplaceData', 'HomeController@getSubWorkplaceData')->name('getSubWorkplaceData');
    Route::post('/updateTraining', 'HomeController@updateTraining')->name('updateTraining');
    Route::post('/updateInterview', 'HomeController@updateInterview')->name('updateInterview');
    Route::post('/updatePreferences', 'HomeController@updatePreferences')->name('updatePreferences');
    Route::post('/updateWorkPreference', 'HomeController@updateWorkPreference')->name('updateWorkPreference');

    Route::post('/updateAdditionalInfo', 'HomeController@updateAdditionalInfo')->name('updateAdditionalInfo');
    Route::post('/updateReference', 'HomeController@updateReference')->name('updateReference');

    Route::post('/deleteReferee', 'HomeController@deleteReferee')->name('deleteReferee');
    Route::post('/deleteCertification', 'HomeController@deleteCertification')->name('deleteCertification');
    Route::post('/deleteOtherTraining', 'HomeController@deleteOtherTraining')->name('deleteOtherTraining');
    Route::post('/deleteOtherEducation', 'HomeController@deleteOtherEducation')->name('deleteOtherEducation');
    Route::post('/deleteWorkExperience', 'HomeController@deleteWorkExperience')->name('deleteWorkExperience');
    Route::post('/deleteImg', 'HomeController@deleteImg')->name('deleteImg');
    Route::post('/deleteImg1', 'HomeController@deleteImg1')->name('deleteImg1');
    Route::post('/deleteImgCert', 'HomeController@deleteImgCert')->name('deleteImgCert');
    Route::post('/deleteanoImgcert', 'HomeController@deleteanoImgcert')->name('deleteanoImgcert');
    Route::post('/uploadImgs', 'HomeController@uploadImgs')->name('uploadImgs');
    Route::post('/uploadImgs1', 'HomeController@uploadImgs1')->name('uploadImgs1');
    Route::post('/uploadmantraImgs1', 'HomeController@uploadmantraImgs1')->name('uploadmantraImgs1');
    Route::post('/uploadAnotherImgs', 'HomeController@uploadAnotherImgs')->name('uploadAnotherImgs');
    Route::post('/deleteTraining', 'HomeController@deleteTraining')->name('deleteTraining');
    Route::post('/deleteAnoImg1', 'HomeController@deleteAnoImg1')->name('deleteAnoImg1');
    Route::post('/deleteImg12', 'HomeController@deleteImg12')->name('deleteImg12');
    Route::post('/deleteotherImg', 'HomeController@deleteotherImg')->name('deleteotherImg');
    Route::post('/deletecertification_img', 'HomeController@deletecertification_img')->name('deletecertification_img');
    Route::post('/getSkillsData', 'HomeController@getSkillsData')->name('getSkillsData');
    Route::post('/deleteevidence', 'HomeController@deleteEvidence')->name('deleteEvidence');

    /**************[Profile Vaccination]**************/
    Route::post('/vaccinationForm', 'HomeController@vaccinationForm')->name('vaccinationForm');
    Route::any('/profileVaccination', 'HomeController@profileVaccination')->name('profileVaccination');
    Route::post('/removeVaccine', 'HomeController@removeVaccine')->name('removeVaccine');
    Route::post('/getContent', 'HomeController@getContent')->name('getContent');
    Route::any('/getVaccinationData', 'HomeController@getVaccinationData')->name('getVaccinationData');
    Route::any('/removeEvidanceFile', 'HomeController@removeEvidanceFile')->name('removeEvidanceFile');
    Route::any('/removeEvidance', 'HomeController@removeEvidance')->name('removeEvidance');

    /**************[Registeration & Licences]**************/
    Route::get('/registration_licences', 'LicencesContoller@registration_licences')->name('registration_licences');
    Route::post('/ahepra_lookup', 'LicencesContoller@ahepra_lookup')->name('ahepra_lookup');
    Route::post('/update_registration_licenses', 'LicencesContoller@update_registration_licenses')->name('update_registration_licenses');
    Route::post('/uploadLicensesEvidenceImgs', 'LicencesContoller@uploadLicensesEvidenceImgs')->name('uploadLicensesEvidenceImgs');
    Route::post('/deleteLicensesEvidenceImg', 'LicencesContoller@deleteLicensesEvidenceImg')->name('deleteLicensesEvidenceImg');
    Route::get('/ahpra-lookup/{number}', 'AhpraLookupsController@lookup1')->name('lookup1');
    Route::post('/editedCountryReg', 'LicencesContoller@editedCountryReg')->name('editedCountryReg');


    /**************[Work Clearance]**************/
    Route::any('/workClearances', 'ProfessionalController@workClearances')->name('workClearances');
    Route::post('/update-profession-user-eligibility', 'ProfessionalController@update_eligibility_to_work')->name('update-profession-user-eligibility');
    Route::post('/update-ndis', 'ProfessionalController@updateNdis')->name('update-ndis');
    Route::post('/update-profession-user-children', 'ProfessionalController@update_children_to_work')->name('update-profession-user-children');
    Route::post('/removeWwcc', 'ProfessionalController@removeWwcc')->name('removeWwcc');
    Route::post('/update-profession-user-police-check', 'ProfessionalController@update_police_check_to_work')->name('update-profession-user-police-check');
    Route::post('/updateSpecializedClearance', 'ProfessionalController@updateSpecializedClearance')->name('updateSpecializedClearance');
    Route::post('/removeSpecialized', 'ProfessionalController@removeSpecialized')->name('removeSpecialized');

    Route::any('/removeEligibilityFile', 'ProfessionalController@removeEligibilityFile')->name('removeEligibilityFile');
    Route::any('/removendisFile', 'ProfessionalController@removendisFile')->name('removendisFile');
    Route::any('/removewwccFile', 'ProfessionalController@removewwccFile')->name('removewwccFile');
    Route::any('/removePolicyFile', 'ProfessionalController@removePolicyFile')->name('removePolicyFile');
    Route::any('/removeSpecializedFile', 'ProfessionalController@removeSpecializedFile')->name('removeSpecializedFile');

    /**************[Setting & Availability]**************/
    Route::get('/setting_availablity', 'HomeController@setting_availablity')->name('setting_availablity');
    Route::post('/update-profession-profile-setting', 'HomeController@update_profession_profile_setting')->name('update-profession-profile-setting');

    /**************[Mandatory Training]**************/
    Route::get('/mandatory_training', 'MandatortrainingController@mandatory_training')->name('mandatory_training');
    Route::post('/uploadTrainingEvidenceImgs', 'MandatortrainingController@uploadTrainingEvidenceImgs')->name('uploadTrainingEvidenceImgs');
    Route::get('/getMandatoryCourses', 'MandatortrainingController@getMandatoryCourses')->name('getMandatoryCourses');
    Route::get('/getMandatoryCoursesName', 'MandatortrainingController@getMandatoryCoursesName')->name('getMandatoryCoursesName');
    Route::post('/deleteTrainingEvidenceImg', 'MandatortrainingController@deleteTrainingEvidenceImg')->name('deleteTrainingEvidenceImg');
    Route::post('/updateMandatoryTraining', 'MandatortrainingController@updateMandatoryTraining')->name('updateMandatoryTraining');

    /**************[Professional Membership]**************/
    Route::any('/professionalMembership', 'ProfessionalController@professionalMembership')->name('professionalMembership');
    Route::any('/getCountryOrgnizations', 'ProfessionalController@getCountryOrgnizations')->name('getCountryOrgnizations');
    Route::any('/getCountrySubOrgnizations', 'ProfessionalController@getCountrySubOrgnizations')->name('getCountrySubOrgnizations');
    Route::any('/getMembershipData', 'ProfessionalController@getMembershipData')->name('getMembershipData');
    Route::any('/getSubMembershipData', 'ProfessionalController@getSubMembershipData')->name('getSubMembershipData');
    Route::any('/getawardsRecognitions', 'ProfessionalController@getawardsRecognitions')->name('getawardsRecognitions');
    Route::post('/updateProfessionalMembership', 'ProfessionalController@updateProfessionalMembership')->name('updateProfessionalMembership');
    Route::post('/uploadMembershipImgs', 'ProfessionalController@uploadMembershipImgs')->name('uploadMembershipImgs');
    Route::post('/uploadAwardImgs', 'ProfessionalController@uploadAwardImgs')->name('uploadAwardImgs');
    Route::post('/deleteEvidenceImg', 'ProfessionalController@deleteEvidenceImg')->name('deleteEvidenceImg');
    Route::post('/deleteAwardEvidenceImg', 'ProfessionalController@deleteAwardEvidenceImg')->name('deleteAwardEvidenceImg');

    /**************[Language Skills]**************/
    Route::get('/language_skills', 'LanguageSkillsContoller@index')->name('language_skills');
    Route::get('/getLanguagesData', 'LanguageSkillsContoller@getLanguagesData')->name('getLanguagesData');
    Route::get('/getSubLanguagesData', 'LanguageSkillsContoller@getSubLanguagesData')->name('getSubLanguagesData');
    Route::get('/getTestLanguagesData', 'LanguageSkillsContoller@getTestLanguagesData')->name('getTestLanguagesData');
    Route::post('/updateLanguageSkills', 'LanguageSkillsContoller@updateLanguageSkills')->name('updateLanguageSkills');
    Route::post('/uploadlangEvidenceImgs', 'LanguageSkillsContoller@uploadlangEvidenceImgs')->name('uploadlangEvidenceImgs');
    Route::post('/deletelangEvidenceImg', 'LanguageSkillsContoller@deletelangEvidenceImg')->name('deletelangEvidenceImg');

    /**************[My-carrer ]**************/
    Route::get('/match_percentage', 'MyCareerController@match_percentage')->name('match_percentage');
    Route::get('matchedJobs', 'MyCareerController@matchedJobs')->name('matchedJobs');
    Route::get('application', 'MyCareerController@application')->name('application');
    Route::get('application-timeline', 'MyCareerController@applicationTimeline')->name('applicationTimeline');
    Route::get('application-archived-timeline', 'MyCareerController@archivedTimeline')->name('archivedTimeline');
    Route::get('action-application', 'MyCareerController@action_application')->name('action_application');
    Route::post('application/withdraw', 'MyCareerController@withdrawApplication')->name('application.withdraw');



    Route::get('MyJobs', 'MyCareerController@MyJobs')->name('MyJobs');
    Route::post('job/change-status', 'MyCareerController@changeStatus')->name('job.changeStatus');
    Route::post('interview/updateStatus', 'MyCareerController@updateInterviewStatus')->name('interview.updateStatus');
    Route::post('interview-cancel', 'MyCareerController@cancelInterview')->name('interview.cancel');



    Route::get('action-interview', 'MyCareerController@action_interview')->name('action_interview');
    Route::get('interviews', 'MyCareerController@interviews_nurse')->name('interviews');
    Route::get('interviews-events', 'MyCareerController@interviews_events')->name('calendar.events');
    Route::post('action-needed-document', 'MyCareerController@action_needed_document')->name('action_needed.upload');
    Route::get('document/delete/{id}', 'MyCareerController@needed_document_delete')->name('action_needed.delete_document');



    /**************[Work Preferences & Flexibility]**************/
    Route::get('/sector_preferences', 'WorkPreferencesController@index')->name('sector_preferences');
    Route::post('/updateSectorPreferences', 'WorkPreferencesController@updateSectorPreferences')->name('updateSectorPreferences');
    Route::get('/work_environment_preferences', 'WorkPreferencesController@work_environment_preferences')->name('work_environment_preferences');
    Route::post('/updateWorkPreferences', 'WorkPreferencesController@updateWorkPreferences')->name('updateWorkPreferences');
    Route::get('/employeement_type_preferences', 'WorkPreferencesController@employeement_type_preferences')->name('employeement_type_preferences');
    Route::get('/getEmpData', 'WorkPreferencesController@getEmpData')->name('getEmpData');
    Route::get('/getEmpDataExp', 'HomeController@getEmpData')->name('getEmpDataExp');
    Route::post('/updateEmpTypePreferences', 'WorkPreferencesController@updateEmpTypePreferences')->name('updateEmpTypePreferences');
    Route::get('/WorkShiftPreferences', 'WorkPreferencesController@WorkShiftPreferences')->name('WorkShiftPreferences');
    Route::post('/updateShiftPreferences', 'WorkPreferencesController@updateShiftPreferences')->name('updateShiftPreferences');
    Route::get('/getSubWorkData', 'WorkPreferencesController@getSubWorkData')->name('getSubWorkData');
    Route::get('/position_preferences', 'WorkPreferencesController@position_preferences')->name('position_preferences');
    Route::post('/updatePositionPreferences', 'WorkPreferencesController@updatePositionPreferences')->name('updatePositionPreferences');
    Route::get('/benefitsPreferences', 'WorkPreferencesController@benefitsPreferences')->name('benefitsPreferences');
    Route::post('/updateBenefitsPreferences', 'WorkPreferencesController@updateBenefitsPreferences')->name('updateBenefitsPreferences');
    Route::get('/locationPreferences', 'WorkPreferencesController@locationPreferences')->name('locationPreferences');
    Route::post('/updateLocationPreferences', 'WorkPreferencesController@updateLocationPreferences')->name('updateLocationPreferences');
    Route::get('/salaryExpectations', 'WorkPreferencesController@salaryExpectations')->name('salaryExpectations');
    Route::post('/updatesalaryExpectations', 'WorkPreferencesController@updatesalaryExpectations')->name('updatesalaryExpectations');

    /**************[Interview Preferences]**************/
    Route::any('/interview', 'ProfessionalController@interview')->name('interview');

    /**************[Find Jobs]**************/
    Route::get('/find_jobs', 'JobsController@index')->name('find_jobs');
    Route::get('/job_details/{job_id}', 'JobsController@job_details')->name('job_details');
    Route::get('/healthcare_details/{id}', 'JobsController@healthcare_details')->name('healthcare_details');
    Route::post('/getWorkFlexiblityData', 'JobsController@getWorkFlexiblityData')->name('getWorkFlexiblityData');
    Route::post('/getWorkEnvironmentData', 'JobsController@getWorkEnvironmentData')->name('getWorkEnvironmentData');
    Route::post('/getNurseData', 'JobsController@getNurseData')->name('getNurseData');
    Route::post('/getSpecialityData', 'JobsController@getSpecialityData')->name('getSpecialityData');
    Route::post('/getFilterData', 'JobsController@getFilterData')->name('getFilterData');
    Route::post('/getExperienceData', 'JobsController@getExperienceData')->name('getExperienceData');
    Route::post('/getFilterNurseData', 'JobsController@getFilterNurseData')->name('getFilterNurseData');
    Route::post('/getFilterSpecialityData', 'JobsController@getFilterSpecialityData')->name('getFilterSpecialityData');
    Route::post('/updateSectorData', 'JobsController@updateSectorData')->name('updateSectorData');
    Route::post('/getJobsSorting', 'JobsController@getJobsSorting')->name('getJobsSorting');
    Route::post('/applyJobs', 'JobsController@applyJobs')->name('applyJobs');
    Route::post('/fetch-job-filters', 'JobsController@fetchJobFilters')->name('fetch-job-filters');
    Route::post('/addSavedSearches', 'JobsController@addSavedSearches')->name('addSavedSearches');
    Route::post('/deleteSearchJobsData', 'JobsController@deleteSearchJobsData')->name('deleteSearchJobsData');
    Route::post('/duplicateSearch', 'JobsController@duplicateSearch')->name('duplicateSearch');
    Route::get('/getEditSearchData', 'JobsController@getEditSearchData')->name('getEditSearchData');
    Route::post('deleteMultipleSearches', 'JobsController@deleteMultipleSearches')->name('deleteMultipleSearches');
    Route::get('/getEmpDataSearch', 'JobsController@getEmpDataSearch')->name('getEmpDataSearch');
    Route::get('/getSavedSearch', 'JobsController@getSavedSearch')->name('getSavedSearch');
    Route::post('remove-filter/{id}', 'JobsController@removeFilter');
    Route::post('updateAlert/{id}', 'JobsController@updateAlert');
    Route::post('run-saved-search/{id}', 'JobsController@run')->name('run-saved-search');
    Route::post('get_tags', 'JobsController@get_tags')->name('get_tags');
    Route::post('get_filters_data', 'JobsController@get_filters_data')->name('get_filters_data');
    Route::get('getEmptypeData', 'JobsController@getEmptypeData')->name('getEmptypeData');
    Route::get('getSpecialityDatas', 'WorkPreferencesController@getSpecialityDatas')->name('getSpecialityDatas');
    Route::get('deleteSpecialityRows', 'HomeController@deleteSpecialityRows')->name('deleteSpecialityRows');
    // notifictaion
    Route::get('/notifications', 'NotificationController@getNotifications')->name('notifications.index');
    Route::post('/notifications/read', 'NotificationController@markAsRead')->name('notifications.read');
    Route::post('/notifications/read-all', 'NotificationController@markAllRead')->name('notifications.readAll');
    Route::get('/notifications-list', 'NotificationController@notificationPage')->name('notifications.page');
  });
});