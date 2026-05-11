<?php
namespace App\Helpers;
use Auth;
use DB;

class CustomHelper{
    public static function multipleFileUpload($file,$dtranaimg)
    {
        $dtran = array();
        if(!empty($file)){
            
            foreach ($file as $dtrans) {
                $destinationPath = public_path() . '/uploads/education_degree';
                $dtrans->move($destinationPath,$dtrans->getClientOriginalName());
                $degree_transcript = $dtrans->getClientOriginalName();

                $dtran[] = $degree_transcript;

                
            }
        }

        if(!empty($dtran)){
            if(!empty($dtranaimg)){
                $new_tran_array = array_unique(array_merge($dtranaimg,$dtran));
            }else{
                $new_tran_array = array_unique($dtran);
            }
            
            $dtranimgs = json_encode($new_tran_array);
        }else{
            $dtranimgs = json_encode($dtranaimg);
        }

        return $dtranimgs;
    }

    public function matchWorkPercent($job,$user){
        $user_id = Auth::guard("nurse_middle")->user()->id;
        $work_preferences = DB::table("work_preferences")->where("user_id",$user->id)->first();

        $sector_preferences = $work_preferences->sector_preferences;
        $found_sector = 0;
        if($sector_preferences == $job->sector){
            $found_sector = 1;
        }

        $json = $work_preferences->work_environment_preferences;
        $jobworkenv_preferences = json_decode($job->work_environment);
        $data = json_decode($json, true);
        //print_r($jobworkenv_preferences);
        // Remove first level key
        $inner = (is_array($data) == true)?reset($data):[];

        $result = [];

        // CALL CORRECTLY
        $this->flattenKeysValues($inner, $result);

        //print_r($result);

        $env_prefer = array_intersect($result, $jobworkenv_preferences);
        $found_env = 0;
        if(!empty($env_prefer)){
            $found_env = 1;
        }

        $emp_preferences = json_decode($work_preferences->emptype_preferences);
        $jobworkemp_preferences = json_decode($job->emplyeement_type);


        $result_emp = [];

        // Loop through each key and merge values
        foreach ($emp_preferences as $arr) {
            foreach ($arr as $val) {
                $result_emp[] = $val;
            }
        }

        //print_r($result);

        $emp_prefer = array_intersect($result_emp, $jobworkemp_preferences);
        $found_emp = 0;
        if(!empty($emp_prefer)){
            $found_emp = 1;
        }

        $position_preferences = json_decode($work_preferences->position_preferences);
        $jobposition_preferences = json_decode($job->emplyeement_positions);

        $inner = (is_array($position_preferences) == true)?reset($position_preferences):[];
       

        $resultposition = [];

        // CALL CORRECTLY
        $this->flattenKeysValues($inner, $resultposition);

        $position_prefer = array_intersect($resultposition, $jobposition_preferences);
        $found_position = 0;
        if(!empty($env_position)){
            $found_position = 1;
        }

        //print_r($resultposition);

        $benefits_preferences = json_decode($work_preferences->benefits_preferences);
        $jobworkbenefits_preferences = json_decode($job->benefits);


        $result_benefits = [];

        // Loop through each key and merge values
        if(!empty($benefits_preferences)){
            foreach ($benefits_preferences as $arr) {
                foreach ($arr as $val) {
                    $result_benefits[] = $val;
                }
            }
        }

        //print_r($result_benefits);

        $benefits_prefer = array_intersect($result_benefits, $jobworkbenefits_preferences);
        $found_benefits = 0;
        if(!empty($benefits_prefer)){
            $found_benefits = 1;
        }


        // -------- MATCH PERCENT -------- //
        $match = $found_sector+$found_env+$found_emp+$found_position+$found_benefits;

        $final_percent = round(($match / 5) * 30);
        //$bar_width = ($match / 2) * 100;

        return $final_percent;
    }

    public function flattenKeysValues($array, &$result) {
        foreach ($array as $key => $value) {

            // Add numeric keys ONLY if value is an array (meaning it's NOT an index)
            if (!is_numeric($key) || is_array($value)) {
                $result[] = $key;
            }

            if (is_array($value)) {
                $this->flattenKeysValues($value, $result);
            } else {
                $result[] = $value;
            }
        }
    }

    public function matchVaccinationRecord($job,$user){
        $vaccination_data = DB::table("vaccination_front")->where("user_id",$user->id)->get();

        $vaccination_arr = [];

        foreach($vaccination_data as $vaccinationd){
            $vaccination_arr[] = $vaccinationd->vaccination_id;
        }

        $jobVaccination = isset($job->vaccination_record)?json_decode($job->vaccination_record):[];

        $getvaccination = array_intersect($vaccination_arr, $jobVaccination);

        $countVaccination = count($getvaccination);

        $final_percent = round(($countVaccination / 9) * 5);

        return $final_percent;
        //print_r($vaccination_arr);
    }

    public function matchclearacesPercent($job,$user){
        $workeligiblity_data = DB::table("eligibility_to_work")->where("user_id",$user->id)->get();
        $ndis_data = DB::table("ndis_screening_check")->where("user_id",$user->id)->get();
        $working_children_data = DB::table("working_children_check")->where("user_id",$user->id)->get();
        $police_check = DB::table("police_check")->where("user_id",$user->id)->get();
        $speacilaized_clearance = DB::table("speacilaized_clearance")->where("user_id",$user->id)->get();

        $work_eligiblity = !empty($workeligiblity_data)?1:0;
        $ndis_eligiblity = !empty($ndis_data)?1:0;
        $children_eligiblity = !empty($working_children_data)?1:0;
        $police_eligiblity = !empty($police_check)?1:0;
        $speacilaized_eligiblity = !empty($speacilaized_clearance)?1:0;

        $match = $work_eligiblity+$ndis_eligiblity+$children_eligiblity+$police_eligiblity+$speacilaized_eligiblity;

        $final_percent = round(($match / 5) * 5);
        //$bar_width = ($match / 2) * 100;

        return $final_percent;
        
    }

    public function matcheduCertPercent($job,$user){

    }
}