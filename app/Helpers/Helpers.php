<?php
use Carbon\Carbon;

use App\Models\SpecialityModel;
use App\Models\PractitionerTypeModel;
use App\Models\CountryModel;
use App\Models\User;
use App\Models\StateModel;
use App\Models\LevelYearModel;
use App\Models\EvidenceModel;
use App\Models\EligibilityToWorkModel;
use App\Models\ProfessionModel;
use App\Models\WorkingChildrenCheckModel;
use App\Models\PoliceCheckModel;
use App\Models\DegreeModel;
use App\Models\EmergencyContactModel;
use App\Models\ProfessionalCer;
use App\Models\TrainingModel;
use App\Models\SkillModel;
use App\Models\VaccinationModel;
use App\Models\JobsModel;
use App\Events\JobPublished;
use App\Notifications\JobPublishedNotification;

function specialty()
{
        $specialty_data =  SpecialityModel::where('parent', '0')->orderBy('nurse_level_order', 'asc')->get();
        return $specialty_data;
}
function specialty_name_by_id($specialty)
{
        $specialty_data =  SpecialityModel::where('id', $specialty)->orderBy('id', 'desc')->first();
        return $specialty_data->name;
}
function specialty_name_by_id_NEW($specialty)
{
        $specialty_data =  SpecialityModel::where('id', $specialty)->orderBy('id', 'desc')->first();
        return $specialty_data->name;
}
function sub_specialty($specialty_id)
{
        $specialty_data =  SpecialityModel::where('parent', $specialty_id)->orderBy('id', 'desc')->get();
        return $specialty_data;
}

function JobSpecialties()
{
        $JobSpecialties =  PractitionerTypeModel::where('status', '1')->where('parent','0')->orderBy('id', 'asc')->get();
        return $JobSpecialties;
}
function SubJobSpecialties()
{
        $SubJobSpecialties =  PractitionerTypeModel::where('status', '1')->where('parent','!=','0')->orderBy('id', 'desc')->get();
        return $SubJobSpecialties;
}
function practitioner_type()
{
        $practitioner_type_data =  PractitionerTypeModel::where('status', '1')->orderBy('id', 'desc')->get();
        return $practitioner_type_data;
}
function nurse_midwife_degree()
{
        $nurse_midwife_degree =  DegreeModel::where('status', '1')->orderBy('id', 'desc')->get();
        return $nurse_midwife_degree;
}
function nurse_midwife_degree_by_id($id)
{
        $nurse_midwife_degree =  DegreeModel::where('status', '1')->where('id', $id)->first();
        return $nurse_midwife_degree->name;
}
function practitioner_type_by_id($practitioner)
{
        $practitioner_type_data =  PractitionerTypeModel::where('id', $practitioner)->orderBy('id', 'desc')->first();
        return $practitioner_type_data->name;
}
function country_phone_code()
{
    $country_phone_code = CountryModel::where('status', '1')->select('phonecode','name')->groupBy('phonecode')->orderBy("phonecode", "asc")->get();
    return $country_phone_code;
}
function country_id($country_phone_code)
{
    $country = CountryModel::where('status', '1')->where('phonecode', $country_phone_code)->first();
    return $country->iso2;
}
function country_name_from_db()
{
        $country_data =  CountryModel::where('status', '1')->get();
        return $country_data;
}
function state_name_array($country_id)
{
        // $lastRecord = StateModel::where('country_id', $country_id)->get();
        $lastRecord = StateModel::where('country_code', $country_id)->get();
        return $lastRecord;
}
function state_name($state_id)
{
        $lastRecord = StateModel::where('id', $state_id)->first();
        return $lastRecord->name;
}
function state_list()
{
        $lastRecord = StateModel::all();

        return $lastRecord;
}
function country_name($country_id)
{

        $lastRecord = CountryModel::where('iso2', $country_id)->first();


        return $lastRecord->name;
}
function country_name_new($country_id)
{

        $lastRecord = CountryModel::where('id', $country_id)->first();
        return $lastRecord->name;
}
function year_level()
{
        $lastRecord = LevelYearModel::where('status','1')->get();
        return $lastRecord;
}
function evidence_list()
{
        $lastRecord = EvidenceModel::where('status','1')->get();
        return $lastRecord;
}
function profession_data()
{
        $lastRecord = ProfessionModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}
function emergency_contact_data()
{
        $lastRecord = EmergencyContactModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}
function clearances_data()
{
        $lastRecord = EligibilityToWorkModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}
function working_data()
{
        $lastRecord = WorkingChildrenCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}
function police_check_data()
{
        $lastRecord = PoliceCheckModel::where('user_id', Auth::guard('nurse_middle')->user()->id)->first();
        if($lastRecord){
            $lastRecord=$lastRecord;
        }else{
            $lastRecord='null';
        }
        return $lastRecord;
}

function getUserDataById($id)
{
        $lastRecord = User::where('id',$id)->first();
        return $lastRecord;
}

function getLevelYearNameById($id)
{
        $lastRecord = LevelYearModel::where('id',$id)->first();
        return $lastRecord->name;
}
function getEvidenceTypeNameById($id)
{
        $lastRecord = EvidenceModel::where('id',$id)->first();
        return $lastRecord->name;
}

function practitioner_type_header()
{
        $practitioner_type_data =  PractitionerTypeModel::where('parent', '0')->orderBy('id', 'desc')->get();
        return $practitioner_type_data;
}
function nurse_Type_header()
{
        $practitioner_type_data =  SpecialityModel::where('parent', '0')->orderBy('id', 'desc')->get();
        return $practitioner_type_data;
}
function email_verified()
{

        if(Auth::guard('nurse_middle')->user()->user_stage=='0'){
                return false;
        }else{
                return true;
        }
}
function account_verified()
{
        if(Auth::guard('nurse_middle')->user()->user_stage=='1'){
                return false;
        }else{
                return true;
        }
}

function completeProfile()
{
        if(Auth::guard('nurse_middle')->user()->user_stage=='4'){
                return false;
        }else{
                return true;
        }
}

function approvedProfile()
{
        if(Auth::guard('nurse_middle')->user()->user_stage=='2'){
                return false;
        }else{
                return true;
        }
}

function update_user_stage($user_id,$tab_name)
{
        $user_data = User::where("id",$user_id)->first();
        $reg_date = $user_data->created_at;

        $date = new DateTime($reg_date);



        // Format to get only the date
        $onlyDate = $date->format('Y-m-d');
        //print_r($user_data);
        if(!empty($user_data) && $user_data->user_stage == 1){
                DB::table("users")->where("id",$user_id)->update(["user_stage"=>"5"]);

                // $to = "votivetester.vijendra@gmail.com";
                $to = "admin@mediqa.com";



                // $mailData = [

                //         'subject' => 'In-progress Nurse Profile',

                //         'email' => $to,


                //         'body' => '<p>Dear Mediqa Team,</p><p>A new Nurse/Midwife has started filling their profile on Mediqa.</p><br><p>User Details:  </p><p>- Name: '.$user_data->name." ".$user_data->lastname.'</p><p>- Email: ['.$user_data->email.']</p><p>- Registration Date: '.$onlyDate.'</p><p>- Profile Progress: '.$tab_name.'</p><br><p>This is an automated notification to inform you of new user activity.</p>',


                // ];


                // Mail::to($to)->send(new \App\Mail\DemoMail($mailData));

                $htmlBody = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                        <meta charset="UTF-8">
                        <title>New User Activity Notification</title>
                        </head>
                        <body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
                                <tr>
                                <td align="center">
                                        <table width="100%" max-width="600" cellpadding="0" cellspacing="0"
                                        style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden;">

                                        <!-- Header -->
                                        <tr>
                                                <td style="background:#0d6efd; padding:20px; text-align:center;">
                                                <h1 style="margin:0; color:#ffffff; font-size:22px;">
                                                        Mediqa Notification
                                                </h1>
                                                </td>
                                        </tr>

                                        <!-- Body -->
                                        <tr>
                                                <td style="padding:30px; color:#333333;">
                                                <p style="margin:0 0 15px;">
                                                        Dear <strong>Mediqa Team</strong>,
                                                </p>

                                                <p style="margin:0 0 20px;">
                                                        A new <strong>Nurse / Midwife</strong> has started filling out their profile on Mediqa.
                                                </p>

                                                <p style="margin:0 0 10px;"><strong>User Details:</strong></p>

                                                <table width="100%" cellpadding="8" cellspacing="0"
                                                        style="border-collapse:collapse; font-size:14px;">
                                                        <tr>
                                                        <td style="border:1px solid #e0e0e0; background:#f9f9f9; width:40%;">
                                                                Name
                                                        </td>
                                                        <td style="border:1px solid #e0e0e0;">
                                                                ' . e($user_data->name . ' ' . $user_data->lastname) . '
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td style="border:1px solid #e0e0e0; background:#f9f9f9;">
                                                                Email
                                                        </td>
                                                        <td style="border:1px solid #e0e0e0;">
                                                                ' . e($user_data->email) . '
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td style="border:1px solid #e0e0e0; background:#f9f9f9;">
                                                                Registration Date
                                                        </td>
                                                        <td style="border:1px solid #e0e0e0;">
                                                                ' . e($onlyDate) . '
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td style="border:1px solid #e0e0e0; background:#f9f9f9;">
                                                                Profile Progress
                                                        </td>
                                                        <td style="border:1px solid #e0e0e0;">
                                                                ' . e($tab_name) . '
                                                        </td>
                                                        </tr>
                                                </table>

                                                <p style="margin:25px 0 0; font-size:14px; color:#777;">
                                                        This is an automated notification to inform you of new user activity.
                                                </p>
                                                </td>
                                        </tr>

                                        <!-- Footer -->
                                        <tr>
                                                <td style="background:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777;">
                                                © ' . '2024' . ' Mediqa. All rights reserved.
                                                </td>
                                        </tr>

                                        </table>
                                </td>
                                </tr>
                        </table>
                        </body>
                        </html>
                        ';

                \App\Helpers\ZeptoMailHelper::sendMail(
                        to: $to,
                        subject: "In-progress Nurse Profile",
                        htmlBody: $htmlBody
                );
        }

        $tab_data = DB::table("updated_tab_name")->where("user_id",$user_id)->where("tab_name",$tab_name)->first();

        $tab_date = Carbon::now('Asia/Kolkata');
        if(empty($tab_data)){
                DB::table("updated_tab_name")->insert(["tab_name"=>$tab_name,"user_id"=>$user_id,"created_at"=>$tab_date]);
        }

        $tab_count = DB::table("updated_tab_name")->where("user_id",$user_id)->get();

        if(count($tab_count) == 15 && empty($tab_data)){

                User::where("id",$user_id)->update(["user_stage"=>"4"]);

                $to = $user_data->email;


                // $mailData = [

                //         'subject' => 'Your Mediqa Profile is Complete',

                //         'email' => $to,


                //         'body' => '<p>Dear '.$user_data->name." ".$user_data->lastname.',</p><p>Congratulations! You have successfully completed your profile on Mediqa.</p><p>Your profile is now ready for review, and once approved, you will be able to:</p><p>- Apply for job opportunities.<br>- Connect with healthcare facilities and agencies.<br>- Receive interview requests and offers that match your skills and preferences.</p><p><strong>Next Steps:</strong></p><p>- Our team will review your profile for approval.<br>- You will receive an email once your profile has been approved.</p><p>If you have any questions, feel free to contact us at <a href="mailto:info@mediqa.com.au">info@mediqa.com.au</a></p><p>Thank you for being part of Mediqa. We look forward to helping you find the best nursing opportunities!</p>',


                // ];


                // Mail::to($to)->send(new \App\Mail\DemoMail($mailData));

                $htmlBodyUser = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                        <meta charset="UTF-8">
                        <title>Profile Completed Successfully</title>
                        </head>
                        <body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
                                <tr>
                                <td align="center">
                                        <table width="100%" max-width="600" cellpadding="0" cellspacing="0"
                                        style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden;">

                                        <!-- Header -->
                                        <tr>
                                                <td style="background:#0d6efd; padding:20px; text-align:center;">
                                                <h1 style="margin:0; color:#ffffff; font-size:22px;">
                                                        Mediqa
                                                </h1>
                                                </td>
                                        </tr>

                                        <!-- Body -->
                                        <tr>
                                                <td style="padding:30px; color:#333333;">
                                                <p style="margin:0 0 15px;">
                                                        Dear <strong>' . e($user_data->name . ' ' . $user_data->lastname) . '</strong>,
                                                </p>

                                                <p style="margin:0 0 15px;">
                                                        <strong>Congratulations!</strong> You have successfully completed your profile on <strong>Mediqa</strong>.
                                                </p>

                                                <p style="margin:0 0 15px;">
                                                        Your profile is now ready for review. Once approved, you will be able to:
                                                </p>

                                                <ul style="margin:0 0 20px 20px; padding:0; font-size:14px;">
                                                        <li style="margin-bottom:8px;">Apply for job opportunities</li>
                                                        <li style="margin-bottom:8px;">Connect with healthcare facilities and agencies</li>
                                                        <li style="margin-bottom:8px;">Receive interview requests and offers that match your skills</li>
                                                </ul>

                                                <p style="margin:0 0 10px;"><strong>Next Steps:</strong></p>
                                                <p style="margin:0 0 20px; font-size:14px;">
                                                        • Our team will review your profile<br>
                                                        • You will receive an email once your profile has been approved
                                                </p>

                                                <p style="margin:0 0 15px; font-size:14px;">
                                                        If you have any questions, feel free to contact us at
                                                        <a href="mailto:info@mediqa.com.au" style="color:#0d6efd; text-decoration:none;">
                                                        info@mediqa.com.au
                                                        </a>
                                                </p>

                                                <p style="margin:20px 0 0;">
                                                        Thank you for being part of <strong>Mediqa</strong>!
                                                </p>
                                                </td>
                                        </tr>

                                        <!-- Footer -->
                                        <tr>
                                                <td style="background:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777;">
                                                © ' . '2024' . ' Mediqa. All rights reserved.
                                                </td>
                                        </tr>

                                        </table>
                                </td>
                                </tr>
                        </table>
                        </body>
                        </html>
                        ';

                \App\Helpers\ZeptoMailHelper::sendMail(
                        to: $to,
                        subject: "Your Mediqa Profile is Complete",
                        htmlBody: $htmlBodyUser
                );

                // $to1 = "votivetester.vijendra@gmail.com";
                $to1 = "admin@mediqa.com";

                $last_tab_date = DB::table("updated_tab_name")->where("user_id",$user_id)->orderBy("tab_id","DESC")->get();

                $last_date = $last_tab_date[0]->created_at;

                $date1 = new DateTime($last_date);

                // Format to get only the date
                $onlyDate1 = $date1->format('Y-m-d');
                // $mailData = [

                //         'subject' => 'Completed Profile – Review Required for Approval',

                //         'email' => $to1,


                //         'body' => '<p>Dear Mediqa Team,</p><p>A user has successfully completed and saved all 11 tabs of their profile on Mediqa and is now awaiting review for approval.</p><br><p>User Details:</p><p>- Name: '.$user_data->name." ".$user_data->lastname.'<br>- Email: '.$user_data->email.'<br>- Registration Date: '.$onlyDate.'<br>- Completion Date: '.$onlyDate1.'</p><br><p>Please review the user\'s profile and approve it as necessary.</p>',


                // ];


                // Mail::to($to1)->send(new \App\Mail\DemoMail($mailData));

                $htmlBodyAdmin = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                        <meta charset="UTF-8">
                        <title>Profile Completed – Approval Required</title>
                        </head>
                        <body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
                                <tr>
                                <td align="center">
                                        <table width="100%" max-width="600" cellpadding="0" cellspacing="0"
                                        style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden;">

                                        <!-- Header -->
                                        <tr>
                                                <td style="background:#0d6efd; padding:20px; text-align:center;">
                                                <h1 style="margin:0; color:#ffffff; font-size:22px;">
                                                        Mediqa – Admin Notification
                                                </h1>
                                                </td>
                                        </tr>

                                        <!-- Body -->
                                        <tr>
                                                <td style="padding:30px; color:#333333;">
                                                <p style="margin:0 0 15px;">
                                                        Dear <strong>Mediqa Team</strong>,
                                                </p>

                                                <p style="margin:0 0 20px;">
                                                        A user has successfully completed all profile sections and is now awaiting approval.
                                                </p>

                                                <p style="margin:0 0 10px;"><strong>User Details:</strong></p>

                                                <table width="100%" cellpadding="8" cellspacing="0"
                                                        style="border-collapse:collapse; font-size:14px;">
                                                        <tr>
                                                        <td style="border:1px solid #e0e0e0; background:#f9f9f9; width:40%;">
                                                                Name
                                                        </td>
                                                        <td style="border:1px solid #e0e0e0;">
                                                                ' . e($user_data->name . ' ' . $user_data->lastname) . '
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td style="border:1px solid #e0e0e0; background:#f9f9f9;">
                                                                Email
                                                        </td>
                                                        <td style="border:1px solid #e0e0e0;">
                                                                ' . e($user_data->email) . '
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td style="border:1px solid #e0e0e0; background:#f9f9f9;">
                                                                Registration Date
                                                        </td>
                                                        <td style="border:1px solid #e0e0e0;">
                                                                ' . e($onlyDate) . '
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                        <td style="border:1px solid #e0e0e0; background:#f9f9f9;">
                                                                Completion Date
                                                        </td>
                                                        <td style="border:1px solid #e0e0e0;">
                                                                ' . e($onlyDate1) . '
                                                        </td>
                                                        </tr>
                                                </table>

                                                <p style="margin:25px 0 0; font-size:14px;">
                                                        Please review the user’s profile and proceed with approval.
                                                </p>
                                                </td>
                                        </tr>

                                        <!-- Footer -->
                                        <tr>
                                                <td style="background:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777;">
                                                © ' . '2024' . ' Mediqa. All rights reserved.
                                                </td>
                                        </tr>

                                        </table>
                                </td>
                                </tr>
                        </table>
                        </body>
                        </html>
                        ';

                \App\Helpers\ZeptoMailHelper::sendMail(
                        to: $to1,
                        subject: "Completed Profile – Review Required for Approval",
                        htmlBody: $htmlBodyAdmin
                );
        }

}

function getUserNameById($id)
{
        $lastRecord = User::where('id',$id)->first();
        if($lastRecord){
                return $lastRecord->name . ' ' . $lastRecord->lastname;
        }

}
function professional_certificate_by_id($id)
{
        $certificate =  ProfessionalCer::where('id', $id)->first();
        return $certificate->name;
}
function training_name_by_id($specialty)
{
        $training_data =  TrainingModel::where('id', $specialty)->first();
        return $training_data->name;
}
function skill_name_by_id($id)
{
        $skill_data =  SkillModel::where('id', $id)->first();
        return $skill_data->name;
}
function vaccination_name_by_id($id)
{
        $vaccination_data =  VaccinationModel::where('id', $id)->first();
        return $vaccination_data->name;
}
function getParentSpecialityId(array $tree, int|string $childId): ?int
{
    $childId = (string) $childId;

    foreach ($tree as $key => $values) {

        // Only process hierarchy keys
        if (!str_starts_with($key, 'type_')) {
            continue;
        }

        // Value must be an array of children
        if (!is_array($values)) {
            continue;
        }

        // Skip speciality_status or associative arrays
        if (array_keys($values) !== range(0, count($values) - 1)) {
            continue;
        }

        if (in_array($childId, $values, true)) {
            return (int) str_replace('type_', '', $key);
        }
    }

    return null;
}

function expire_jobs($user_id)
{
        $job_box_data = JobsModel::where("healthcare_id",$user_id)->where("save_draft",2)->get();

        $newDate = '';
        foreach($job_box_data as $job_box){
            $custom_expiry_date = $job_box->custom_expiry_date;
            $today_date = date('Y-m-d');

            $expiry_date = $job_box->expiry_date;
            if($expiry_date == 1){
                $date = $job_box->created_at;

                $newDate = date('Y-m-d', strtotime($date . ' +1 days'));

            }

            if($expiry_date == 2){
                $date = $job_box->created_at;

                $newDate = date('Y-m-d', strtotime($date . ' +14 days'));

            }

            if($expiry_date == 3){
                $date = $job_box->created_at;

                $newDate = date('Y-m-d', strtotime($date . ' +30 days'));

            }

            if($expiry_date == 4){
                $date = $job_box->created_at;

                $newDate = date('Y-m-d', strtotime($date . ' +60 days'));

            }

            if($expiry_date != 5 && $today_date >= $newDate){
                $status_change = JobsModel::find($job_box->id);
                $status_change->save_draft = 3;
                $status_change->save();
            }


            if($expiry_date == 5 && $today_date > $custom_expiry_date){
                $status_change = JobsModel::find($job_box->id);
                $status_change->save_draft = 3;
                $status_change->save();
            }


        }
}

function normalizeJsonValues($value)
{
    $decoded = json_decode($value, true);

    if (!is_array($decoded)) {
        return [];
    }

    $result = [];

    array_walk_recursive($decoded, function ($item) use (&$result) {
        $result[] = (string) $item;
    });

    return array_values(array_unique(array_filter($result)));
}

function normalizeSimpleArray($value)
{
    $decoded = json_decode($value, true);

    if (!is_array($decoded)) {
        return [];
    }

    return collect($decoded)
        ->flatten()
        ->map(fn($v) => (string) $v)
        ->filter()
        ->values()
        ->toArray();
}

/**
 * For benefits like:
 * {"1":["11"],"2":["17"],"3":["51"]}
 *
 * Returns:
 * ["1","11","2","17","3","51"]
 */
function normalizeBenefitIds($value)
{
    $decoded = json_decode($value, true);

    if (!is_array($decoded)) {
        return [];
    }

    $result = [];

    foreach ($decoded as $key => $vals) {
        $result[] = (string) $key;

        if (is_array($vals)) {
            foreach ($vals as $v) {
                $result[] = (string) $v;
            }
        } else {
            $result[] = (string) $vals;
        }
    }

    return array_values(array_unique(array_filter($result)));
}

function sendJobAlertEmails()
{
    $savedSearches = DB::table('saved_searches')->get();
    $jobs = DB::table('job_boxes')->get();

    foreach ($savedSearches as $search) {

        $matchedJobs = [];

        foreach ($jobs as $job) {

            $totalFilters = 0;
            $matchedFilters = 0;
            $matchedFields = [];

            // Mandatory match flags
            $shiftMatched = false;
            $benefitsMatched = false;

            /*
            |--------------------------------------------------------------------------
            | 1. SHIFT TYPE
            |--------------------------------------------------------------------------
            */
            $searchShift = normalizeSimpleArray($search->filter_work_shift ?? null);

            if (!empty($searchShift)) {
                $totalFilters++;

                $jobShift = normalizeSimpleArray($job->shift_type ?? null);

                if (!empty(array_intersect($jobShift, $searchShift))) {
                    $matchedFilters++;
                    $matchedFields[] = 'Shift Type';
                    $shiftMatched = true;
                }
            } else {
                $shiftMatched = true;
            }

            /*
            |--------------------------------------------------------------------------
            | 2. WORK ENVIRONMENT
            |--------------------------------------------------------------------------
            */
            $searchEnv = normalizeJsonValues($search->filter_work_environment ?? null);

            if (!empty($searchEnv)) {
                $totalFilters++;

                $jobEnv = normalizeJsonValues($job->work_environment ?? null);

                if (!empty(array_intersect($jobEnv, $searchEnv))) {
                    $matchedFilters++;
                    $matchedFields[] = 'Work Environment';
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 3. BENEFITS
            |--------------------------------------------------------------------------
            */
            $searchBenefits = normalizeSimpleArray($search->filter_benefits_preferences ?? null);

            if (!empty($searchBenefits)) {
                $totalFilters++;

                // IMPORTANT FIX: match keys + nested values
                $jobBenefits = normalizeBenefitIds($job->benefits ?? null);

                if (!empty(array_intersect($jobBenefits, $searchBenefits))) {
                    $matchedFilters++;
                    $matchedFields[] = 'Benefits';
                    $benefitsMatched = true;
                }
            } else {
                $benefitsMatched = true;
            }

            /*
            |--------------------------------------------------------------------------
            | 4. EXPERIENCE
            |--------------------------------------------------------------------------
            */
            if (!empty($search->experience)) {
                $totalFilters++;

                $jobExperience = (int) ($job->experience ?? 0);
                $searchExperience = (int) ($search->experience ?? 0);

                // Recommended logic
                if ($jobExperience <= $searchExperience) {
                    $matchedFilters++;
                    $matchedFields[] = 'Experience';
                }
            }

            /*
            |--------------------------------------------------------------------------
            | MATCH %
            |--------------------------------------------------------------------------
            */
            $matchPercentage = $totalFilters > 0
                ? round(($matchedFilters / $totalFilters) * 100, 2)
                : 0;

            /*
            |--------------------------------------------------------------------------
            | FINAL RULE
            |--------------------------------------------------------------------------
            */
            if ($matchPercentage >= 50 && $shiftMatched && $benefitsMatched) {

                if (!collect($matchedJobs)->pluck('id')->contains($job->id)) {

                    $job->match_percentage = $matchPercentage;
                    $job->matched_filters = $matchedFilters;
                    $job->total_filters = $totalFilters;
                    $job->matched_fields = $matchedFields;

                    $job->shift_label = !empty($job->shift_type)
                        ? implode(', ', normalizeSimpleArray($job->shift_type))
                        : 'N/A';

                    $job->salary_label = !empty($job->salary)
                        ? $job->salary
                        : 'N/A';

                    $job->location_label = trim(
                        ($job->city ?? '') . ', ' .
                        ($job->state ?? '') . ', ' .
                        ($job->country ?? ''),
                        ', '
                    );

                    if (empty($job->location_label)) {
                        $job->location_label = $job->location ?? 'N/A';
                    }

                    $matchedJobs[] = $job;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SEND EMAIL / NOTIFICATION
        |--------------------------------------------------------------------------
        */
        if (!empty($matchedJobs)) {

            // Optional: top 5 best jobs only
            $matchedJobs = collect($matchedJobs)
                ->sortByDesc('match_percentage')
                ->take(5)
                ->values()
                ->all();

            //$user = DB::table('users')->where('id', $search->user_id)->first();
            $user = User::whereHasAppNotifications()
                        ->where('id', $search->user_id)
                        ->first();

            if ($user && !empty($user->email)) {

                // Render blade HTML correctly
                $htmlBody = view('email.job-alert', [
                    'user' => $user,
                    'jobs' => $matchedJobs,
                    'savedSearch' => $search, // IMPORTANT: use same variable as blade
                ])->render();

                // Send Email
                // \App\Helpers\ZeptoMailHelper::sendMail(
                //     $user->email,
                //     "Job Alert - Mediqa",
                //     $htmlBody
                // );

                foreach ($matchedJobs as $matchedJob) {
                        $jobModel = \App\Models\JobsModel::find($matchedJob->id);

                        if ($jobModel) {
                                // This will store in database AND broadcast in real-time
                                // (if user has app notifications enabled via hasAppNotification())
                                $user->notify(new JobPublishedNotification($jobModel));
                        }
                }

                //JobPublished::dispatch($matchedJobs);



                // $user->notify(new JobPublishedNotification($matchedJobs));

                // JobPublished::dispatch($matchedJobs);

                // //Laravel Notification
                // if ($user instanceof \Illuminate\Notifications\Notifiable || method_exists($user, 'notify')) {
                //     $userModel = \App\Models\User::find($user->id);
                //     if ($userModel) {
                //         $userModel->notify(new JobPublishedNotification($matchedJobs));
                //     }
                // }

                // //Broadcast event
                // JobPublished::dispatch($matchedJobs);
            }
        }

        // Debug
        // echo "<pre>";
        // print_r($matchedJobs);
    }
}

function filterSummuryData($filter_data){
    $sector = isset($filter_data['sector']) ? $filter_data['sector'] : '';

    $filterNameData = [];

    if($sector == 1){
        $sector_data = 'Public & Government';
        $filterNameData['sector'] = $sector_data;
    }

    if($sector == 2){
        $sector_data = 'Private';
        $filterNameData['sector'] = $sector_data;
    }

    if($sector == 3){
        $sector_data = 'Public Government & Private';
        $filterNameData['sector'] = $sector_data;
    }

    $employment_type = isset($filter_data['employment_type']) ? $filter_data['employment_type'] : [];
    $emp_arr = [];
    foreach($employment_type as $emptype){
        $emp_data = DB::table("employeement_type_preferences")->where("emp_prefer_id",$emptype)->first();
        $emp_arr[] =  $emp_data->emp_type;
    }

    $filterNameData['employment_type'] = $emp_arr;

    $work_shift_type = isset($filter_data['work_shift']) ? $filter_data['work_shift'] : [];
    $work_shift_arr = [];
    foreach($work_shift_type as $work_shift){
        $work_shift_data = DB::table("work_shift_preferences")->where("work_shift_id",$work_shift)->first();
        $work_shift_arr[] =  $work_shift_data->shift_name;
    }

    $filterNameData['work_shift'] = $work_shift_arr;

    $work_environment_type = isset($filter_data['work_environment']) ? $filter_data['work_environment'] : [];
    $work_environment_arr = [];
    foreach($work_environment_type as $work_environment){
        $work_environment_data = DB::table("work_enviornment_preferences")->where("prefer_id",$work_environment)->first();
        $work_environment_arr[] =  $work_environment_data->env_name;
    }

    $filterNameData['work_environment'] = $work_environment_arr;

    $benefits_preferences_type = isset($filter_data['benefits_preferences']) ? $filter_data['benefits_preferences'] : [];
    $benefits_preferences_arr = [];
    foreach($benefits_preferences_type as $benefits_preferences){
        $benefits_preferences_data = DB::table("work_enviornment_preferences")->where("prefer_id",$benefits_preferences)->first();
        $benefits_preferences_arr[] =  $benefits_preferences_data->env_name;
    }

    $filterNameData['benefits_preferences'] = $benefits_preferences_arr;

    $nurse_type = isset($filter_data['nurse_type']) ? $filter_data['nurse_type'] : [];
    $nurse_type_arr = [];
    foreach($nurse_type as $ntype){
        $nurse_type_data = DB::table("practitioner_type")->where("id",$ntype)->first();
        $nurse_type_arr[] =  $nurse_type_data->name;
    }

    $filterNameData['nurse_type'] = $nurse_type_arr;

    $speciality_type = isset($filter_data['speciality']) ? $filter_data['speciality'] : [];
    $speciality_type_arr = [];
    foreach($speciality_type as $stype){
        $speciality_type_data = DB::table("speciality")->where("id",$stype)->first();
        $speciality_type_arr[] =  $speciality_type_data->name;
    }

    $filterNameData['speciality'] = $speciality_type_arr;

    $filterNameData['location_preference'] = isset($filter_data['location_preference']) ?$filter_data['location_preference']:'';
    $filterNameData['experience_years'] = isset($filter_data['experience_years']) ?$filter_data['experience_years'].' years':'';
    $filterNameData['salary'] = isset($filter_data['salary']) ?$filter_data['salary']:'';

    return json_encode($filterNameData);
}

function filterSummuryNurseData($filter_data)
{
    $filterNameData = [];


     $nurse_type = $filter_data['nurse_type'] ?? [];

    if (!empty($nurse_type)) {

        $nurseData = DB::table("practitioner_type")
            ->whereIn("id", $nurse_type)
            ->pluck('name', 'id')
            ->toArray();

        $nurse_arr = [];

        foreach ($nurse_type as $nurse) {
            if (isset($nurseData[$nurse])) {
                $nurse_arr[] = [
                    'field_name'=>'Type of Nurse',    
                    'id' => (string)$nurse,
                    'name' => $nurseData[$nurse]
                ];
            }
        }

        $filterNameData['nurse_type'] = $nurse_arr;
    }

    $speciality = $filter_data['specialty_type'] ?? [];

    if (!empty($speciality)) {

        $specialityData = DB::table("speciality")
            ->whereIn("id", $speciality)
            ->pluck('name', 'id')
            ->toArray();

        $specialty_arr = [];

        foreach ($speciality as $spec) {
            if (isset($specialityData[$spec])) {
                $specialty_arr[] = [
                    'field_name'=>'Specialty',     
                    'id' => (string)$spec,
                    'name' => $specialityData[$spec]
                ];
            }
        }

        $filterNameData['specialty_type'] = $specialty_arr;
    }

    $work_environment = $filter_data['workEnvironment'] ?? [];
    

    if (!empty($work_environment)) {

        $work_envData = DB::table("work_enviornment_preferences")
            ->whereIn("prefer_id", $work_environment)
            ->pluck('env_name', 'prefer_id')
            ->toArray();
        //print_r($work_envData);                                                        

        $work_env_arr = [];

        foreach ($work_environment as $work) {
            if (isset($work_envData[$work])) {
                $work_env_arr[] = [
                    'field_name'=>'Work Environment',    
                    'id' => (string)$work,
                    'name' => $work_envData[$work]
                ];
            }
        }

        $filterNameData['work_environment'] = $work_env_arr;
    }

     $employment_type = $filter_data['employment_type'] ?? [];
    

    if (!empty($employment_type)) {

        $empData = DB::table("employeement_type_preferences")
            ->whereIn("emp_prefer_id", $employment_type)
            ->pluck('emp_type', 'emp_prefer_id')
            ->toArray();
        //print_r($work_envData);                                                        

        $emp_arr = [];

        foreach ($employment_type as $employment) {
            if (isset($empData[$employment])) {
                $emp_arr[] = [
                    'field_name'=>'Employment Type',    
                    'id' => (string)$employment,
                    'name' => $empData[$employment]
                ];
            }
        }

        $filterNameData['employment_type'] = $emp_arr;
    }

    $shift_type = $filter_data['shiftType'] ?? [];
    

    if (!empty($shift_type)) {

        $shiftData = DB::table("work_shift_preferences")
            ->whereIn("work_shift_id", $shift_type)
            ->pluck('shift_name', 'work_shift_id')
            ->toArray();
        //print_r($work_envData);                                                        

        $shift_arr = [];

        foreach ($shift_type as $shift) {
            if (isset($shiftData[$shift])) {
                $shift_arr[] = [
                    'field_name'=>'Shift Type',    
                    'id' => (string)$shift,
                    'name' => $shiftData[$shift]
                ];
            }
        }

        $filterNameData['shift_type'] = $shift_arr;
    }
    /*
    |--------------------------------------------------------------------------
    | ✅ CERTIFICATIONS (Optimized with whereIn)
    |--------------------------------------------------------------------------
    */
    $certifications = $filter_data['certification'] ?? [];

    if (!empty($certifications)) {

        // Fetch from both tables in one go
        $certData = DB::table("professional_certificate")
            ->whereIn("id", $certifications)
            ->pluck('name', 'id')
            ->toArray();

        $certData1 = DB::table("professional_certificate_table")
            ->whereIn("professionalcert_id", $certifications)
            ->pluck('name', 'professionalcert_id')
            ->toArray();

        $certifications_arr = [];

        foreach ($certifications as $cert) {

            // Priority: first table, then second
            if (isset($certData[$cert])) {
                $certifications_arr[] = [
                    'field_name'=>'Certifications',    
                    'id' => (string)$cert,
                    'name' => $certData[$cert]
                ];
            } elseif (isset($certData1[$cert])) {
                $certifications_arr[] = [
                    'field_name'=>'Certifications',    
                    'id' => (string)$cert,
                    'name' => $certData1[$cert]
                ];
            }
        }

        $filterNameData['certification'] = $certifications_arr;
    }

    if (isset($filter_data['salary']) && is_array($filter_data['salary'])) {
        $filterNameData['salary'] = [
            'min' => $filter_data['salary']['min'] ?? '',
            'max' => $filter_data['salary']['max'] ?? ''
        ];
    }

    $year_experience = $filter_data['year_experience'] ?? [];

    $experience_arr = [];

    if(!empty($year_experience)){
        $experience_arr[] = [
                'field_name'=>'Experience',    
                
                'name' => $year_experience." year"
        ];  
        
      $filterNameData['year_experience'] = $experience_arr;                                                          
    }

    $salary = $filter_data['salary'] ?? [];

    $salary_arr = [];

    if(!empty($salary)){
        $salary_arr[] = [
                'field_name'=>'Salary',    
                
                'name' => "$".$salary->min."-"."$".$salary->max
        ];  
        
      $filterNameData['salary'] = $salary_arr;                                                          
    }

    $degree = $filter_data['degree'] ?? [];

    

    if(!empty($degree)){
       

        $degreeData = DB::table("degree")
            ->whereIn("id", $degree)
            ->pluck('name', 'id')
            ->toArray();
        //print_r($work_envData);                                                        

        $degree_arr = [];

        foreach ($degree as $deg) {
            if (isset($degreeData[$deg])) {
                $degree_arr[] = [
                    'field_name'=>'Education',    
                    'id' => (string)$deg,
                    'name' => $degreeData[$deg]
                ];
            }
        }
        
      $filterNameData['degree'] = $degree_arr;                                                          
    }

    $language = $filter_data['language'] ?? [];

    

    if(!empty($language)){
       

        $languageData = DB::table("languages")
            ->whereIn("language_id", $language)
            ->pluck('language_name', 'language_id')
            ->toArray();
        //print_r($work_envData);                                                        

        $lang_arr = [];

        foreach ($language as $lang) {
            if (isset($languageData[$lang])) {
                $lang_arr[] = [
                    'field_name'=>'Language',    
                    'id' => (string)$lang,
                    'name' => $languageData[$lang]
                ];
            }
        }
        
      $filterNameData['language'] = $lang_arr;                                                          
    }

    $check_clearance = $filter_data['check_clearance'] ?? [];
    //print_r($check_clearance);
    if(!empty($check_clearance)){
       
                                                             

        $check_clearance_arr = [];

        foreach ($check_clearance as $check) {
            
                $check_clearance_arr[] = [
                    'field_name'=>'Checks Clearance',    
                    'id' => (string)$check,
                    'name' => $check
                ];
            
        }
        
      $filterNameData['check_clearance'] = $check_clearance_arr;                                                          
    }

    

    return json_encode($filterNameData, JSON_UNESCAPED_UNICODE);
}