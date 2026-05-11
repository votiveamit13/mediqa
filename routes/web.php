<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\nurse\HomeController;
use App\Http\Controllers\admin\NurseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\admin\StripeWebhookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Custom Broadcasting Auth for multiple guards
Route::post('/broadcasting/auth', function (Request $request) {
    if (Auth::guard('nurse_middle')->check()) {
        $user = Auth::guard('nurse_middle')->user();
    } elseif (Auth::guard('healthcare_facilities')->check()) {
        $user = Auth::guard('healthcare_facilities')->user();
    } elseif (Auth::check()) {
        $user = Auth::user();
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Temporarily set the user on the request so Broadcast::auth can find them
    $request->setUserResolver(fn() => $user);

    return Broadcast::auth($request);
})->middleware(['web']);

// ===========
// Admin Route
// ===========
 Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('handleWebhook');
Route::get('/sync-stripe-products', [StripeWebhookController::class, 'syncStripeProducts']);
Route::get('/ahepra_lookup', 'App\Http\Controllers\nurse\LicencesContoller@myFunction')->name('myFunction');
Route::prefix('/admin')->name('admin.')->namespace('App\Http\Controllers\admin')->group(function () {
  Route::match(['get', 'post'], '/', 'AuthController@login')->name('login');
  Route::post('/loginAction', 'AuthController@doLogin')->name('loginAction');
  Route::get('/forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
  Route::post('/verifyEmail', 'AuthController@verifyEmail')->name('verifyEmail');


  Route::middleware('admin')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/my-profile', 'DashboardController@myProfile')->name('my-profile');
    Route::post('/update-profile', 'DashboardController@updateProfile')->name('update-profile');
    Route::post('/change-password', 'DashboardController@changePassword')->name('change-password');

    // Profession Managemenent
    Route::get('/professionList', 'SpecialityController@specialityList')->name('professionList');
    Route::post('/addSpeciality', 'SpecialityController@addSpeciality')->name('addSpeciality');
    Route::post('/updateSpeciality', 'SpecialityController@updateSpeciality')->name('updateSpeciality');
    Route::post('/deleteSpeciality', 'SpecialityController@deleteSpeciality')->name('deleteSpeciality');
    Route::post('/getSpeciality', 'SpecialityController@getSpeciality')->name('getSpeciality');

    // Sub Profession  Managemenent
    Route::get('/practitionertypeList/{id}', 'SpecialityController@subspecialityList')->name('practitionertypeList');
    Route::post('/addSubspeciality', 'SpecialityController@addSubspeciality')->name('addSubspeciality');
    Route::post('/updateSubspeciality', 'SpecialityController@updateSubspeciality')->name('updateSubspeciality');
    Route::post('/deleteSubspeciality', 'SpecialityController@deleteSubspeciality')->name('deleteSubspeciality');
    Route::post('/getSubspeciality', 'SpecialityController@getSubspeciality')->name('getSubspeciality');
    Route::get('/practitionersubtypeList/{id}', 'SpecialityController@SubtypeofNurse')->name('practitionersubtypeList');
    Route::post('/viewsubprofessionalcert', 'SpecialityController@addSubspeciality')->name('addSubspeciality');


    // Speciality Managemenent
    Route::get('/specialityList', 'SpecialityController@specialityNewList')->name('specialityList');
    Route::post('/addNewSpeciality', 'SpecialityController@addNewSpeciality')->name('addNewSpeciality');
    Route::post('/updateNewSpeciality', 'SpecialityController@updateNewSpeciality')->name('updateNewSpeciality');
    Route::post('/deleteNewSpeciality', 'SpecialityController@deleteNewSpeciality')->name('deleteNewSpeciality');
    Route::post('/getNewSpeciality', 'SpecialityController@getNewSpeciality')->name('getNewSpeciality');

    // Sub Job  Managemenent
    Route::get('/subjobSpecialitiesList/{id}', 'SpecialityController@subjobSpecialitiesList')->name('subjobSpecialitiesList');
    Route::post('/addSubspecialityJob', 'SpecialityController@addSubspecialityJob')->name('addSubspecialityJob');
    Route::post('/updateSubspecialityJob', 'SpecialityController@updateSubspecialityJob')->name('updateSubspecialityJob');
    Route::post('/deleteSubspeciality', 'SpecialityController@deleteSubspeciality')->name('deleteSubspeciality');
    Route::post('/getSubspecialityJob', 'SpecialityController@getSubspecialityJob')->name('getSubspecialityJob');

    // Sub  sub Job  Managemenent
    Route::get('/SubsubjobSpecialitiesList/{id}', 'SpecialityController@SubsubjobSpecialitiesList')->name('SubsubjobSpecialitiesList');
    Route::get('/SubSpecialitiesjobList/{id}', 'SpecialityController@SubmenujobSpecialitiesList')->name('SubSpecialitiesjobList');

    // Nurse Managemenent
    Route::get('/customer-list', 'NurseController@customerList')->name('customer-list');
    Route::get('/healthcare-list', 'HealthcareController@index')->name('healthcareList');
    Route::get('/healthcare-detail/{id}', 'HealthcareController@healthcare_details')->name('healthcare_details');
    Route::get('/add_healthcare','HealthcareController@add_healthcare')->name('add_healthcare');
    Route::post('/post_healthcare','HealthcareController@post_healthcare')->name('post_healthcare');
    Route::get('/edit_healthcare/{id}','HealthcareController@edit_healthcare')->name('edit_healthcare');
    Route::get('/plan_management', 'HealthcareController@plan_list')->name('plan_list');
    Route::get('/add_plans', 'HealthcareController@add_plans')->name('add_plans');
    Route::post('/updatePlan', 'HealthcareController@update_plan')->name('updatePlan');
    Route::get('/update_plans/{id}', 'HealthcareController@update_plans')->name('update_plans');


    Route::get('/show_invoice', 'HealthcareController@show_invoice')->name('show_invoice');
    Route::get('/show_customers', 'HealthcareController@show_customers')->name('show_customers');
    Route::get('/recruiter-list', 'HealthcareController@recruiter_list')->name('recruiter_list');
    Route::get('/add_compliance_security', 'HealthcareController@add_compliance_security')->name('add_compliance_security');
    Route::post('/update_compliance_security', 'HealthcareController@update_compliance_security')->name('update_compliance_security');
    Route::get('/incoming-nurse-list', 'NurseController@incommingNurseList')->name('incoming-nurse-list');
    Route::get('/unverified-nurse-list', 'NurseController@unverified_nurse_list')->name('unverified-nurse-list');
    Route::post('/send_remainder', 'NurseController@send_remainder')->name('send_remainder');
    Route::get('/complete-profile-nurse-list', 'NurseController@completeprofileNurseList')->name('complete-nurse-nurse-list');
    Route::get('/inprogess-profile-nurse-list', 'NurseController@inProgressprofileNurseList')->name('inprogess-nurse-nurse-list');
    Route::get('/approved-nurse-list', 'NurseController@activeNurseList')->name('approved-nurse-list');

    Route::get('/nurse-application-list/{id}', 'NurseController@nurse_application')->name('application_list');
    Route::post('/change-status', 'NurseController@changeStatus')->name('change-status');
    Route::post('/change-status-delete', 'NurseController@changeStatusDelete')->name('change-status-delete');
    Route::post('/change-status-block-unblock', 'NurseController@changeStatusBlockUnblock')->name('change-status-block-unblock');
    Route::get('/view-profile/{id}', 'NurseController@viewProfile')->name('view-profile');
    Route::get('/view-certicate/{id}', 'NurseController@view_certificate')->name('view-certicate');
    Route::any('/add-nurse', 'NurseController@addNurse')->name('add_nurse');
    Route::post('/add-nurse-post-1', 'NurseController@addNursePostForm1')->name('add_nurse_post_1');
    Route::post('/add-nurse-post-2', 'NurseController@addNursePostForm2')->name('add_nurse_post_2');
    Route::post('/add-nurse-post-3', 'NurseController@addNursePostForm3')->name('add_nurse_post_3');
    Route::post('/add-nurse-post-4', 'NurseController@addNursePostForm4')->name('add_nurse_post_4');
    Route::post('/add-nurse-post-5', 'NurseController@addNursePostForm5')->name('add_nurse_post_5');
    Route::post('/add-nurse-post-6', 'NurseController@addNursePostForm6')->name('add_nurse_post_6');
    Route::post('/add-nurse-post-7', 'NurseController@addNursePostForm7')->name('add_nurse_post_7');
    Route::post('/add-nurse-post-8', 'NurseController@addNursePostForm8')->name('add_nurse_post_8');
    Route::post('/add-nurse-post-9', 'NurseController@addNursePostForm9')->name('add_nurse_post_9');
    Route::post('/add-nurse-post-10', 'NurseController@addNursePostForm10')->name('add_nurse_post_10');
    Route::post('/add-nurse-post-11', 'NurseController@addNursePostForm11')->name('add_nurse_post_11');
    Route::post('/add-nurse-post-13', 'NurseController@addNursePostForm13')->name('add_nurse_post_13');
    Route::post('/add-nurse-post-14', 'NurseController@addNursePostForm14')->name('add_nurse_post_14');
    Route::post('/add-nurse-post-15', 'NurseController@addNursePostForm15')->name('add_nurse_post_15');
    Route::get('/edit-nurse/{id?}', 'NurseController@EditNurse')->name('edit_nurse');
    Route::post('/edit-nurse-post', 'NurseController@EditNursePost')->name('edit_nurse_post');
    Route::post('/delete-cer-img', 'NurseController@deleteCertificateImg')->name('delete_cer_img');
    Route::post('/upload-deg-img', 'NurseController@UploadDegreeImg')->name('upload-deg-img');
    Route::post('/dlt-deg-img', 'NurseController@deleteDegImg')->name('dlt-deg-img');
    Route::post('/uploadImgs', 'NurseController@uploadImgs')->name('uploadImgs1');
    Route::post('/dlt-deg-img', 'NurseController@deleteDegImg')->name('dlt-deg-img');
    Route::post('/deleteImg1', 'NurseController@deleteImg1')->name('deleteImg1');
    Route::post('/uploadmantraImgs1', 'NurseController@uploadmantraImgs1')->name('uploadmantraImgs1');
    Route::post('/uploadAnotherImgs', 'NurseController@uploadAnotherImgs')->name('uploadAnotherImgs');
    Route::post('/deleteAnoImg1', 'NurseController@deleteAnoImg1')->name('deleteAnoImg1');
    Route::get('/customer-list', 'NurseController@customerList')->name('customer-list');
    Route::post('/get-registered-countries',[NurseController::class, 'getRegisteredCountries'])->name('get-registered-countries');
    Route::post('/update-registered-country-status',[NurseController::class, 'updateRegisteredCountryStatus'])->name('update-registered-country-status');


    // Skill  Managemenent
    Route::get('/skillList', 'SkillController@skillList')->name('skillList');
    Route::post('/addSkill', 'SkillController@addSkill')->name('addSkill');
    Route::post('/updateSkill', 'SkillController@updateSkill')->name('updateSkill');
    Route::post('/deleteSkill', 'SkillController@deleteSkill')->name('deleteSkill');
    Route::post('/getSkill', 'SkillController@getSkill')->name('getSkill');

    // Degree  Managemenent
    Route::get('/degreeList', 'DegreeController@degreeList')->name('degreeList');
    Route::post('/addDegree', 'DegreeController@addDegree')->name('addDegree');
    Route::post('/updateDegree', 'DegreeController@updateDegree')->name('updateDegree');
    Route::post('/deleteDegree', 'DegreeController@deleteDegree')->name('deleteDegree');
    Route::post('/getDegree', 'DegreeController@getDegree')->name('getDegree');

    // Verification Managemenent
    Route::get('/professionVerificationList', 'VerificationController@professionVerificationList')->name('professionVerificationList');
    Route::post('/changeProfessionVerificationStatus', 'VerificationController@changeProfessionVerificationStatus')->name('changeProfessionVerificationStatus');
    Route::get('/policeCheckVerificationList', 'VerificationController@policeCheckVerificationList')->name('policeCheckVerificationList');
    Route::post('/changePoliceCheckVerificationStatus', 'VerificationController@changePoliceCheckVerificationStatus')->name('changePoliceCheckVerificationStatus');

    // Certificate  Managemenent
    Route::get('/professional-certificate-list', 'ProfessionalcerController@certificateList')->name('certificateList');
    Route::post('/add-certificate', 'ProfessionalcerController@addCertificate')->name('addcertificate');
    Route::post('/update-certificate', 'ProfessionalcerController@updateCertificate')->name('updateCertificate');
    Route::post('/delete-certificate', 'ProfessionalcerController@deleteCertificate')->name('deleteCertificate');
    Route::post('/get-certificate', 'ProfessionalcerController@getCertificate')->name('getCertificate');

    //Sub certificated Management
    Route::get('/professional-subcertificate-list/{id}', 'ProfessionalcerController@certificateSubList')->name('professional-subcertificate-list');
    Route::post('/addGeneralCertificate', 'ProfessionalcerController@addGeneralCertificate')->name('addGeneralCertificate');
    Route::post('/get-sub-certificate', 'ProfessionalcerController@getsubCertificate')->name('getsubCertificate');
    Route::post('/update-sub-certificate', 'ProfessionalcerController@updatesubCertificate')->name('updatesubCertificate');
    Route::post('/delete-sub-certificate', 'ProfessionalcerController@deleteSubCertificate')->name('deleteSubCertificate');

    //Training  Managemenent
    Route::get('/training-list', 'TrainingController@TrainingList')->name('TrainingList');
    Route::post('/add-training', 'TrainingController@addTraining')->name('addTraining');
    Route::post('/update-training', 'TrainingController@updateTraining')->name('updateTraining');
    Route::post('/delete-training', 'TrainingController@deleteTraining')->name('deleteTraining');
    Route::post('/get-training', 'TrainingController@getTraining')->name('getTraining');

    //Vaccination  Managemenent
    Route::get('/vaccination-list', 'VaccinationController@VaccinationList')->name('VaccinationList');
    Route::post('/add-vaccination', 'VaccinationController@addVaccination')->name('addVaccination');
    Route::post('/update-vaccination', 'VaccinationController@updateVaccination')->name('updateVaccination');
    Route::post('/delete-vaccination', 'VaccinationController@deleteVaccination')->name('deleteVaccination');
    Route::post('/get-vaccination', 'VaccinationController@getVaccination')->name('getVaccination');
    Route::get('/evidence-list', 'VaccinationController@EvidenceList')->name('EvidenceList');
    Route::post('/add-evidence', 'VaccinationController@addEvidence')->name('addEvidence');
    Route::post('/get-evidence', 'VaccinationController@getEvidence')->name('getEvidence');
    Route::post('/update-evidence', 'VaccinationController@updateEvidence')->name('updateEvidence');
    Route::post('/delete-evidence', 'VaccinationController@deleteEvidence')->name('deleteEvidence');
    Route::get('/immunization-status-list', 'VaccinationController@imStatusList')->name('imStatusList');
    Route::post('/add-imm-status', 'VaccinationController@addImmStatus')->name('addImmStatus');
    Route::post('/get-imm-status', 'VaccinationController@getImmStatus')->name('getImmStatus');
    Route::post('/update-imm-status', 'VaccinationController@updateImmStatus')->name('updateImmStatus');
    Route::post('/delete-imm-status', 'VaccinationController@deleteImmStatus')->name('deleteImmStatus');

    //Seo  Managemenent
    Route::get('/content_pagelist', 'SeoController@SeoList')->name('SeoList');
    Route::post('/add-page', 'SeoController@addSeo')->name('addSeo');
    Route::post('/update-seo', 'SeoController@updateSeo')->name('updateSeo');
    Route::post('/delete-seo', 'SeoController@deleteSeo')->name('deleteSeo');
    Route::post('/get-seo', 'SeoController@getSeo')->name('getSeo');

    //Mandatory Training  and Education
    Route::get('/training-education-list', 'MantrainingController@mantrainingList')->name('traeductionList');
    Route::post('/add-man-training', 'MantrainingController@addManTraining')->name('addManTraining');
    Route::post('/update-man-training', 'MantrainingController@updateManTraining')->name('updateManTraining');
    Route::post('/delete-man-training', 'MantrainingController@deleteManTraining')->name('deleteManTraining');
    Route::post('/get-man-training', 'MantrainingController@getManTraining')->name('getManTraining');
    Route::get('/sub-training-education-list/{id}', 'MantrainingController@subManTrainingList')->name('subManTrainingList');
    Route::post('/add-sub-man-training', 'MantrainingController@addSubMantraining')->name('addSubMantraining');
    Route::post('/delete-sub-man-training', 'MantrainingController@deleteSubMantraining')->name('deleteSubMantraining');
    Route::post('/get-sub-man-training', 'MantrainingController@getSubMantraining')->name('getSubMantraining');
    Route::post('/update-sub-man-training', 'MantrainingController@updateSubMantraining')->name('updateSubMantraining');

    /* contact us list */
    Route::get('/contact-list', 'ContentController@contactList')->name('contact-list');

    // tab routes
    Route::any('/exp-tab/{id?}', 'NurseController@viewExpTab')->name('exptab');
    Route::any('/man-tra-tab/{id?}', 'NurseController@viewManTraTab')->name('mantratab');
    Route::post('/getSkillsData', 'NurseController@getSkillsData')->name('getSkillsData');
    Route::post('/exp-data', 'NurseController@Experienceupdate')->name('exp-data');
    Route::post('/man-tr-data', 'NurseController@ManTraupdate')->name('man-tr-data');

    /**************[Setting & Availability]**************/
    Route::get('/setting_availablity', 'NurseController@setting_availablity')->name('setting_availablity');
    Route::post('/update-profession-profile-setting', 'NurseController@update_profession_profile_setting')->name('update-profession-profile-setting');
    Route::get('/setting_availablity_view/{id}', 'NurseprofileController@setting_availablity_view')->name('setting_availablity_view');
    Route::get('/profession_view/{id}', 'NurseprofileController@profession_view')->name('profession_view');
    Route::get('/education_certification/{id}', 'NurseprofileController@education_certification')->name('education_certification');
    Route::get('/registration_licenses/{id}', 'NurseprofileController@registration_licenses')->name('registration_licenses');
    Route::get('/experience_view/{id}', 'NurseprofileController@experience_view')->name('experience_view');
    Route::post('/ahpra_reverify', 'NurseprofileController@ahpra_reverify')->name('ahpra_reverify');
    Route::get('/professional_membership/{id}', 'NurseprofileController@professional_membership')->name('professional_membership');
    Route::get('/language_skills/{id}', 'NurseprofileController@language_skills')->name('language_skills');
    Route::get('/references_view/{id}', 'NurseprofileController@view_references')->name('view_references');
    Route::get('/vaccination_view/{id}', 'NurseprofileController@vaccination_view')->name('vaccination_view');
    Route::get('/checks_clearacnces/{id}', 'NurseprofileController@checks_clearacnces')->name('checks_clearacnces');
    Route::get('/mandatory_training_view/{id}', 'NurseprofileController@mandatory_training_view')->name('mandatory_training_view');
    Route::get('/add_registration_licences/{id}', 'NurseprofileController@add_registration_licences')->name('add_registration_licences');
    Route::post('/ahepra_lookup', 'NurseprofileController@ahepra_lookup')->name('ahepra_lookup');
    Route::post('/update_registration_licenses', 'NurseprofileController@update_registration_licenses')->name('update_registration_licenses');
    Route::post('/uploadLicensesEvidenceImgs', 'NurseprofileController@uploadLicensesEvidenceImgs')->name('uploadLicensesEvidenceImgs');
    Route::post('/deleteLicensesEvidenceImg', 'NurseprofileController@deleteLicensesEvidenceImg')->name('deleteLicensesEvidenceImg');
    Route::post('/fetch-ahpra-details', 'AhpraLookupsController@getAhpraDetails')->name('getAhpraDetails');
    Route::get('/mandatory_training_edit/{id}', 'NurseprofileController@mandatory_training_edit')->name('mandatory_training_edit');
    Route::get('/professional_membership_awards/{id}', 'MembershipController@index')->name('professional_membership_awards');
    Route::any('/getCountryOrgnizations','MembershipController@getCountryOrgnizations')->name('getCountryOrgnizations');
    Route::any('/getCountrySubOrgnizations','MembershipController@getCountrySubOrgnizations')->name('getCountrySubOrgnizations');
    Route::any('/getMembershipData','MembershipController@getMembershipData')->name('getMembershipData');
    Route::any('/getSubMembershipData','MembershipController@getSubMembershipData')->name('getSubMembershipData');
    Route::any('/getawardsRecognitions','MembershipController@getawardsRecognitions')->name('getawardsRecognitions');
    Route::post('/updateProfessionalMembership', 'MembershipController@updateProfessionalMembership')->name('updateProfessionalMembership');
    Route::post('/uploadMembershipImgs', 'MembershipController@uploadMembershipImgs')->name('uploadMembershipImgs');
    Route::post('/uploadAwardImgs', 'MembershipController@uploadAwardImgs')->name('uploadAwardImgs');
    Route::post('/deleteEvidenceImg', 'MembershipController@deleteEvidenceImg')->name('deleteEvidenceImg');
    Route::post('/deleteAwardEvidenceImg', 'MembershipController@deleteAwardEvidenceImg')->name('deleteAwardEvidenceImg');
    Route::get('/addlanguage_skills/{id}', 'LanguageSkillsController@editLanguageSkills')->name('editLanguageSkills');
    Route::get('/getLanguagesData', 'LanguageSkillsController@getLanguagesData')->name('getLanguagesData');
    Route::get('/getSubLanguagesData', 'LanguageSkillsController@getSubLanguagesData')->name('getSubLanguagesData');
    Route::get('/getTestLanguagesData', 'LanguageSkillsController@getTestLanguagesData')->name('getTestLanguagesData');
    Route::post('/updateLanguageSkills', 'LanguageSkillsController@updateLanguageSkills')->name('updateLanguageSkills');
    Route::post('/uploadlangEvidenceImgs', 'LanguageSkillsController@uploadlangEvidenceImgs')->name('uploadlangEvidenceImgs');
    Route::post('/deletelangEvidenceImg', 'LanguageSkillsController@deletelangEvidenceImg')->name('deletelangEvidenceImg');

    /************[Nurse Profile Vaccination]*************/
    Route::post('/addNurseVaccination', 'NurseController@addNurseVaccination')->name('addNurseVaccination');
    Route::any('/updateVaccinationRecord/{id?}', 'NurseController@updateVaccinationRecord')->name('updateVaccinationRecord');
    Route::any('/getVaccinationData', 'NurseController@getVaccinationData')->name('getVaccinationData');
    Route::any('/removeEvidanceFile', 'NurseController@removeEvidanceFile')->name('removeEvidanceFile');
    Route::post('/removeVaccine', 'NurseController@removeVaccine')->name('removeVaccine');
    Route::any('/removeEvidance', 'NurseController@removeEvidance')->name('removeEvidance');
    Route::any('/updateNurseVaccination', 'NurseController@updateNurseVaccination')->name('updateNurseVaccination');

    /************[Nurse Profile Work Cleareance]*************/
    Route::any('/updateWorkClreance/{id?}', 'NurseController@updateWorkClreance')->name('updateWorkClreance');
    Route::post('/update-profession-user-eligibility', 'NurseController@update_eligibility_to_work')->name('update-profession-user-eligibility');
    Route::post('/update-ndis', 'NurseController@updateNdis')->name('update-ndis');
    Route::post('/update-profession-user-children', 'NurseController@update_children_to_work')->name('update-profession-user-children');
    Route::post('/removeWwcc', 'NurseController@removeWwcc')->name('removeWwcc');
    Route::post('/update-profession-user-police-check', 'NurseController@update_police_check_to_work')->name('update-profession-user-police-check');
    Route::post('/updateSpecializedClearance', 'NurseController@updateSpecializedClearance')->name('updateSpecializedClearance');
    Route::post('/removeSpecialized', 'NurseController@removeSpecialized')->name('removeSpecialized');

     /************[Professional Membership & Awards]*************/
    Route::any('/professionalMembership','NurseController@professionalMembership')->name('professionalMembership');
    Route::get('/organization_country_list','ProfessionalMembership@countryList')->name('organization_country_list');
    Route::post('/addCountry', 'ProfessionalMembership@addCountry')->name('addCountry');
    Route::post('/getCountry', 'ProfessionalMembership@getCountry')->name('getCountry');
    Route::post('/updateCountry', 'ProfessionalMembership@updateCountry')->name('updateCountry');
    Route::post('/deleteCountry', 'ProfessionalMembership@deleteCountry')->name('deleteCountry');
    Route::get('/suborganization_country_list/{id}','ProfessionalMembership@subcountryList')->name('suborganization_country_list');
    Route::get('/suborganization_country/{id}/{country_id}','ProfessionalMembership@subcountry')->name('suborganization_country');
    Route::get('/membershipType', 'ProfessionalMembership@membershipType')->name('membershipType');
    Route::get('/submembershipType/{id}', 'ProfessionalMembership@subMemberList')->name('submembershipType');
    Route::post('/addMembershipType', 'ProfessionalMembership@addMembershipType')->name('addMembershipType');
    Route::post('/getMembership', 'ProfessionalMembership@getMembership')->name('getMembership');
    Route::post('/updateMembership', 'ProfessionalMembership@updateMembership')->name('updateMembership');
    Route::post('/deleteMembership', 'ProfessionalMembership@deleteMembership')->name('deleteMembership');
    Route::get('/awards_list','ProfessionalMembership@awards_list')->name('awards_list');
    Route::post('/addAwards', 'ProfessionalMembership@addAwards')->name('addAwards');
    Route::post('/getAwards', 'ProfessionalMembership@getAwards')->name('getAwards');
    Route::post('/updateAwards', 'ProfessionalMembership@updateAwards')->name('updateAwards');
    Route::post('/deleteAwards', 'ProfessionalMembership@deleteAwards')->name('deleteAwards');
    Route::get('/subAwardsList/{id}', 'ProfessionalMembership@subAwardsList')->name('subAwardsList');

    /************[Language Skills]*************/
    Route::get('/language_list','LanguageSkillsController@language_list')->name('language_list');
    Route::post('/addLanguages', 'LanguageSkillsController@addLanguages')->name('addLanguages');
    Route::post('/getLanguages', 'LanguageSkillsController@getLanguages')->name('getLanguages');
    Route::post('/updateLanguages', 'LanguageSkillsController@updateLanguages')->name('updateLanguages');
    Route::post('/deleteLanguages', 'LanguageSkillsController@deleteLanguages')->name('deleteLanguages');
    Route::get('/sub_language_list/{id}','LanguageSkillsController@sub_language_list')->name('sub_language_list');
    Route::get('/certification_list','LanguageSkillsController@certification_list')->name('certification_list');

     /************[Work Preferences]*************/
    Route::get('/work_preferences','WorkPreferencesController@work_environment_list')->name('work_preferences');
    Route::post('/addWorkEnvironment', 'WorkPreferencesController@addWorkEnvironment')->name('addWorkEnvironment');
    Route::post('/getEnvironment', 'WorkPreferencesController@getEnvironment')->name('getEnvironment');
    Route::post('/updateWorkEnvironment', 'WorkPreferencesController@updateWorkEnvironment')->name('updateWorkEnvironment');
    Route::post('/deleteEnvironment', 'WorkPreferencesController@deleteEnvironment')->name('deleteEnvironment');
    Route::get('/sub_env_list/{id}','WorkPreferencesController@sub_env_list')->name('sub_env_list');
    Route::get('/subsub_env_list/{id}/{sub_env_id}','WorkPreferencesController@subsub_env_list')->name('subsub_env_list');
    Route::get('/position_management','WorkPreferencesController@position_list')->name('position_list');
    Route::post('/addPosition', 'WorkPreferencesController@addPosition')->name('addPosition');
    Route::post('/getPosition', 'WorkPreferencesController@getPosition')->name('getPosition');
    Route::post('/updatePosition', 'WorkPreferencesController@updatePosition')->name('updatePosition');
    Route::post('/deletePosition', 'WorkPreferencesController@deletePosition')->name('deletePosition');
    Route::get('/sub_position/{id}', 'WorkPreferencesController@sub_position')->name('sub_position');
    Route::get('/work_shift_preferences','WorkPreferencesController@work_shift_preferences')->name('work_shift_preferences');
    Route::post('/addWorkShift', 'WorkPreferencesController@addWorkShift')->name('addWorkShift');
    Route::post('/getWorkShift', 'WorkPreferencesController@getWorkShift')->name('getWorkShift');
    Route::post('/updateWorkShift', 'WorkPreferencesController@updateWorkShift')->name('updateWorkShift');
    Route::post('/deleteWorkShift', 'WorkPreferencesController@deleteWorkShift')->name('deleteWorkShift');
    Route::get('/sub_work_shift/{id}','WorkPreferencesController@sub_work_shift')->name('sub_work_shift');
    Route::get('/sub_balance_shift/{id}/{shift_id}','WorkPreferencesController@sub_balance_shift')->name('sub_balance_shift');
    Route::get('/benefit_preferences','WorkPreferencesController@benefit_preferences')->name('benefit_preferences');
    Route::post('/addBenefits', 'WorkPreferencesController@addBenefits')->name('addBenefits');
    Route::post('/getBenefits', 'WorkPreferencesController@getBenefits')->name('getBenefits');
    Route::post('/updateBenefits', 'WorkPreferencesController@updateBenefits')->name('updateBenefits');
    Route::post('/deleteBenefits', 'WorkPreferencesController@deleteBenefits')->name('deleteBenefits');
    Route::get('/sub_benefits/{id}','WorkPreferencesController@sub_benefits')->name('sub_benefits');
    Route::get('/employeement_type','WorkPreferencesController@employeement_type_list')->name('employeement_type');
    Route::post('/addEmployeementType', 'WorkPreferencesController@addEmplyeementType')->name('addEmplyeementType');
    Route::post('/getEmployeementType', 'WorkPreferencesController@getEmployeementType')->name('getEmployeementType');
    Route::post('/updateEmployeementType', 'WorkPreferencesController@updateEmployeementType')->name('updateEmployeementType');
    Route::post('/deleteEmployeementType', 'WorkPreferencesController@deleteEmployeementType')->name('deleteEmployeementType');
    Route::get('/sub_employeement_type/{id}','WorkPreferencesController@sub_employeement_type')->name('sub_employeement_type');

    /************[Job Boxes]*************/
	Route::get('/add_jobs','JobsController@index')->name('add_jobs');
    Route::post('/addJobs', 'JobsController@addJobs')->name('addJobs');
    Route::get('/jobList', 'JobsController@jobList')->name('jobList');
    Route::get('/edit_jobs/{id}','JobsController@edit_jobs')->name('edit_jobs');
    Route::get('/view_jobs/{id}','JobsController@job_details')->name('view_jobs');
    Route::get('/applied-nurse-list/{id}','JobsController@applied_nurse_list')->name('applied_nurse_list');


  });

Route::get('/nurse/email-verification/{token}', [HomeController::class, 'email_verification'])
    ->name('legacy.verify.token');
});

// ==========================================
// Chat System Routes
// ==========================================

// Nurse Chat Routes
Route::prefix('nurse/chat')->name('nurse.chat.')->middleware(['auth:nurse_middle', 'user.online'])->group(function () {
    Route::get('/', 'App\Http\Controllers\nurse\ChatController@index')->name('index');
    Route::get('/conversation/{id}', 'App\Http\Controllers\nurse\ChatController@showConversation')->name('show');
    Route::get('/start/{jobId}', 'App\Http\Controllers\nurse\ChatController@chatFromJob')->name('from_job');
    Route::get('/healthcare-list', 'App\Http\Controllers\nurse\ChatController@healthcareList')->name('healthcare_list');
    Route::get('/get-healthcare-facilities', 'App\Http\Controllers\nurse\ChatController@getHealthcareFacilities')->name('get_healthcare');
    Route::post('/create-from-application/{applicationId}', 'App\Http\Controllers\nurse\ChatController@createConversationFromApplication')->name('create_from_application');
    Route::post('/send', 'App\Http\Controllers\ChatController@sendMessage')->name('send');
    Route::post('/start', 'App\Http\Controllers\ChatController@startConversation')->name('start');
    Route::post('/upload', 'App\Http\Controllers\ChatController@uploadAttachment')->name('upload');
    Route::post('/delete', 'App\Http\Controllers\ChatController@deleteMessage')->name('delete');
    Route::post('/block', 'App\Http\Controllers\ChatController@blockUser')->name('block');
    Route::post('/delete-conversation', 'App\Http\Controllers\ChatController@deleteConversation')->name('delete_conversation');
    Route::post('/archive', 'App\Http\Controllers\ChatController@archiveConversation')->name('archive');
    Route::post('/mark-as-read', 'App\Http\Controllers\ChatController@markAsRead')->name('mark_as_read');
    Route::post('/mark-as-delivered', 'App\Http\Controllers\ChatController@markAsDelivered')->name('mark_as_delivered');
    Route::post('/message-read', 'App\Http\Controllers\ChatController@markMessageRead')->name('message_read');
    Route::post('/typing', 'App\Http\Controllers\ChatController@typingStatus')->name('typing');
    Route::post('/online-status', 'App\Http\Controllers\ChatController@updateOnlineStatus')->name('online_status');
    Route::get('/check-status/{userId}', 'App\Http\Controllers\ChatController@checkUserStatus')->name('check_status');
    Route::get('/search', 'App\Http\Controllers\ChatController@search')->name('search');
    Route::get('/unread-count', 'App\Http\Controllers\ChatController@unreadCount')->name('unread_count');
});

// Healthcare Chat Routes
Route::prefix('healthcare-facilities/chat')->name('healthcare.chat.')->middleware(['auth:healthcare_facilities', 'user.online'])->group(function () {
    Route::get('/', 'App\Http\Controllers\medical_facilities\ChatController@index')->name('index');
    Route::get('/conversation/{id}', 'App\Http\Controllers\medical_facilities\ChatController@showConversation')->name('show');
    Route::get('/nurses', 'App\Http\Controllers\medical_facilities\ChatController@nursesList')->name('nurses');
    Route::get('/start/{nurseId}', 'App\Http\Controllers\medical_facilities\ChatController@chatFromNurseProfile')->name('from_profile');
    Route::get('/job/{jobId}/conversations', 'App\Http\Controllers\medical_facilities\ChatController@jobConversations')->name('job_conversations');
    Route::post('/send', 'App\Http\Controllers\ChatController@sendMessage')->name('send');
    Route::post('/start', 'App\Http\Controllers\ChatController@startConversation')->name('start');
    Route::post('/upload', 'App\Http\Controllers\ChatController@uploadAttachment')->name('upload');
    Route::post('/delete', 'App\Http\Controllers\ChatController@deleteMessage')->name('delete');
    Route::post('/block', 'App\Http\Controllers\ChatController@blockUser')->name('block');
    Route::post('/delete-conversation', 'App\Http\Controllers\ChatController@deleteConversation')->name('delete_conversation');
    Route::post('/archive', 'App\Http\Controllers\ChatController@archiveConversation')->name('archive');
    Route::post('/mark-as-read', 'App\Http\Controllers\ChatController@markAsRead')->name('mark_as_read');
    Route::post('/mark-as-delivered', 'App\Http\Controllers\ChatController@markAsDelivered')->name('mark_as_delivered');
    Route::post('/message-read', 'App\Http\Controllers\ChatController@markMessageRead')->name('message_read');
    Route::post('/typing', 'App\Http\Controllers\ChatController@typingStatus')->name('typing');
    Route::post('/online-status', 'App\Http\Controllers\ChatController@updateOnlineStatus')->name('online_status');
    Route::get('/check-status/{userId}', 'App\Http\Controllers\ChatController@checkUserStatus')->name('check_status');
    Route::get('/search', 'App\Http\Controllers\ChatController@search')->name('search');
    Route::get('/unread-count', 'App\Http\Controllers\ChatController@unreadCount')->name('unread_count');
});
