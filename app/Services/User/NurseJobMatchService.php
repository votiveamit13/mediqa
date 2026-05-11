<?php

namespace App\Services\User;

class NurseJobMatchService
{

    public function calculateMatch($user,$nurseTypes, $nurseSpecialties, $experience_data, $nurseVaccines, $eligibility, $policeCheck, $workingChildren, $ndisCheck, $preferences = '', $job)
    {
        $score = 0;

        $score += $this->typeScore($nurseTypes, $job);
        $score += $this->specialtyScore($nurseSpecialties, $job);
        $score += $this->experienceScore($experience_data, $job);
        $score += $this->vaccinationScore($nurseVaccines, $job);
        $score += $this->checksClearanceScore(
            $eligibility,
            $policeCheck,
            $workingChildren,
            $ndisCheck,
            $job
        );
        $score += $this->workPreferenceScore($preferences, $job);
        $score += $this->educationBlockScore($user, $job);
        return round($score, 2);
    }
    private function toArray($data)
    {
        if (is_string($data)) {
            return json_decode($data, true);
        }
        return $data ?? [];
    }
    private function educationBlockScore($user, $job)
    {
        $score = 0;

        $score += $this->educationScore($user, $job);   // 5
        $score += $this->trainingScore($user, $job);    // 5
        $score += $this->languageScore($user, $job);    // 5

        return $score;
    }
    private function educationScore($user, $job)
    {
        $weight = 5;

        $jobDegrees = $this->toArray($job->degree_req);

        if (empty($jobDegrees) || in_array('no_minimum', $jobDegrees)) {
            return $weight;
        }

        // Rank mapping (based on your table)
        $rankMap = [
            'certificate' => 1,
            'bachelor' => 2,
            'postgraduate' => 3,
            'masters' => 4,
            'doctorate' => 5,
        ];

        // Get user rank
        $userDegree = $user->degree;
        $userDegreeId = is_object($user->degree) ? $user->degree->id : $user->degree;
        $userRank = DB::table('degree')->where('id', $userDegreeId)->value('rank');

        if (!$userRank || !isset($rankMap[$userRank])) {
            return 0;
        }

        $userRankValue = $rankMap[$userRank];

        // Check against job requirement
        foreach ($jobDegrees as $degree) {
            if (isset($rankMap[$degree]) && $userRankValue >= $rankMap[$degree]) {
                return $weight;
            }
        }

        return 0;
    }
        private function trainingScore($user, $job)
    {
        $weight = 5;

        $jobTrainings = $this->toArray($job->mandatory_training_req) ?? [];
        $userTrainings = $this->toArray($user->trainings ?? []) ?? [];

        if (empty($jobTrainings)) {
            return $weight;
        }

        $jobFlat = $this->flattenArray($jobTrainings);
        $userKeys = array_keys($userTrainings);

        if (count($jobFlat) == 0) return $weight;

        return (count(array_intersect($jobFlat, $userKeys)) / count($jobFlat)) * $weight;
    }

    private function languageScore($user, $job)
    {
        $weight = 5;

        // If $user is not an object, bail out safely
        if (!is_object($user) || !property_exists($user, 'langprof_level')) {
            return 0; // or $weight if you want to give full score by default
        }

        $jobLang  = $this->toArray($job->sub_languages_req) ?? [];
        $userLang = $this->toArray($user->langprof_level) ?? [];

        if (empty($jobLang)) {
            return $weight;
        }

        $jobKeys  = array_keys((array) $jobLang);
        $userKeys = array_keys((array) $userLang);

        $matched = array_intersect($jobKeys, $userKeys);

        if (count($jobKeys) == 0) return $weight;

        return (count($matched) / count($jobKeys)) * $weight;
    }


    private function workPreferenceScore($preferences, $job)
    {
        $score = 0;

        $score += $this->sectorScore($preferences, $job);
        $score += $this->shiftScore($preferences, $job);

        $score += $this->employmentScore($preferences, $job);

        $score += $this->benefitsScore($preferences, $job);
        $score += $this->locationSalaryScore($preferences, $job);

        return ($score / 25) * 30; // ✅ scaled to 30%
    }
    
    private function sectorScore($preferences, $job)
    {
        $weight = 5;

        if (empty($preferences->sector_preferences) || empty($job->sector)) {
            return 0;
        }

        $userSector = strtolower($preferences->sector_preferences); // public/private
        $jobSector = $job->sector; // 1,2,3

        // Example mapping (adjust if needed)
        $map = [
            'public' => [1],
            'private' => [2],
            'both' => [1, 2, 3]
        ];

        if (isset($map[$userSector]) && in_array($jobSector, $map[$userSector])) {
            return $weight;
        }

        return 0;
    }

    function flattenArray($array)
    {
        $result = [];

        array_walk_recursive($array, function ($item) use (&$result) {
            $result[] = $item;
        });

        return $result;
    }
    private function shiftScore($preferences, $job)
    {
        $weight = 5;

        // Handle user data
        $user = $preferences->work_shift_preferences ?? null;
        if (is_string($user)) {
            $user = json_decode($user, true);
        }

        // Handle job data
        $jobShift = $job->shift_type;
        if (is_string($jobShift)) {
            $jobShift = json_decode($jobShift, true);
        }

        if (empty($user) || empty($jobShift)) {
            return 0;
        }

        $userFlat = $this->flattenArray($user);

        return count(array_intersect($userFlat, $jobShift)) > 0 ? $weight : 0;
    }
    private function employmentScore($preferences, $job)
    {
        $weight = 5;

        // Handle user data
        $user = $preferences->emptype_preferences ?? null;
        if (is_string($user)) {
            $user = json_decode($user, true);
        }

        // Handle job data
        $jobType = $job->emplyeement_type;

        if (is_string($jobType)) {
            $decoded = json_decode($jobType, true);
            $jobType = is_array($decoded) ? $decoded : [$jobType]; // ✅ force array
        }

        if (empty($user) || empty($jobType)) {
            return 0;
        }

        $userFlat = $this->flattenArray($user);

        return count(array_intersect($userFlat, $jobType)) > 0 ? $weight : 0;
    }

    private function benefitsScore($preferences, $job)
    {
        $weight = 5;

        // $user = json_decode($preferences->benefits_preferences, true) ?? null;
        $user = null;
        if (!empty($preferences->benefits_preferences)) {
            $decoded = json_decode($preferences->benefits_preferences, true);
            $user = is_array($decoded) ? $decoded : null;
        }

        $jobBenefits = json_decode($job->benefits, true);

        if (!$user || !$jobBenefits) {
            return 0;
        }

        $userFlat = $this->flattenArray($user);
        $jobFlat = $this->flattenArray($jobBenefits);

        $matched = array_intersect($userFlat, $jobFlat);

        if (count($jobFlat) == 0) {
            return $weight;
        }

        return (count($matched) / count($jobFlat)) * $weight;
    }
    private function locationSalaryScore($preferences, $job)
    {
        $weight = 5;
        $score = 0;

        // LOCATION
        if (!empty($preferences->location_status) && !empty($job->location)) {
            if ($preferences->location_status == $job->location) {
                $score += 2.5;
            }
        }

        // SALARY
        if (!empty($preferences->salary_expectations) && !empty($job->salary)) {
            if ($job->salary >= $preferences->salary_expectations) {
                $score += 2.5;
            }
        }

        return $score;
    }
    private function checksClearanceScore($eligibility, $policeCheck, $workingChildren, $ndisCheck, $job)
    {
        $weight = 5;

        if (empty($job->checks_clearance_req)) {
            return $weight;
        }

        $requirements = $job->checks_clearance_req;

        if (is_string($requirements)) {
            $requirements = json_decode($requirements, true);
        }

        if (!is_array($requirements) || count($requirements) == 0) {
            return $weight;
        }

        $requiredChecks = 0;
        $matchedChecks = 0;

        $eligibilityGroup = ['citizen', 'pr', 'visa', 'sponsorship', 'bridging', 'supervised'];

        if (count(array_intersect($requirements, $eligibilityGroup)) > 0) {

            $requiredChecks++;

            if ($eligibility) {
                $matchedChecks++;
            }
        }

        if (in_array('ndis_screen_check', $requirements)) {

            $requiredChecks++;

            if ($ndisCheck) {
                $matchedChecks++;
            }
        }

        if (in_array('working_children', $requirements)) {

            $requiredChecks++;

            if ($workingChildren) {
                $matchedChecks++;
            }
        }
        if (in_array('police_clearance', $requirements)) {

            $requiredChecks++;

            if ($policeCheck) {
                $matchedChecks++;
            }
        }

        if ($requiredChecks == 0) {
            return $weight;
        }

        return ($matchedChecks / $requiredChecks) * $weight;
    }

    private function vaccinationScore($nurseVaccines, $job)
    {
        $weight = 5;

        // If job has no vaccination requirement → full score
        if (empty($job->vaccination_req) || $job->vaccination_req == "[]" || $job->vaccination_req == null) {
            return $weight;
        }

        $jobVaccines = $job->vaccination_req;

        // Convert JSON to array
        if (is_string($jobVaccines)) {
            $jobVaccines = json_decode($jobVaccines, true);
        }

        if (!is_array($jobVaccines) || count($jobVaccines) == 0) {
            return $weight; // treat as no requirement
        }

        $jobVaccines = array_map('intval', $jobVaccines);

        $matched = array_intersect($nurseVaccines, $jobVaccines);

        $score = (count($matched) / count($jobVaccines)) * $weight;

        return $score;
    }

    private function typeScore($nurseTypes, $job)
    {
        $weight = 15;
        if (empty($nurseTypes)) {
            return 0;
        }
        $jobTypes = $job->nurse_type_id;
        if (is_string($jobTypes)) {
            $jobTypes = json_decode($jobTypes, true);
        }
        if (!is_array($jobTypes)) {
            return 0;
        }
        $jobTypes = array_map('intval', $jobTypes);
        $matched = array_intersect($nurseTypes, $jobTypes);
        return count($matched) > 0 ? $weight : 0;
    }

    private function specialtyScore($nurseSpecialties, $job)
    {
        $weight = 15;
        if (empty($nurseSpecialties)) {
            return 0;
        }
        $jobTypes = $job->typeofspeciality;
        if (is_string($jobTypes)) {
            $jobTypes = json_decode($jobTypes, true);
        }
        if (!is_array($jobTypes)) {
            return 0;
        }
        $jobTypes = array_map('intval', $jobTypes);
        $matched = array_intersect($nurseSpecialties, $jobTypes);
        return count($matched) > 0 ? $weight : 0;
    }

    private function experienceScore($nurseData, $job)
    {
        $weight = 15;
        $jobSpecialties = $job->typeofspeciality;

        if (is_string($jobSpecialties)) {
            $jobSpecialties = json_decode($jobSpecialties, true);
        }

        if (!is_array($jobSpecialties)) {
            return 0;
        }

        // find nurse records with matching specialty
        $matched = $nurseData->whereIn('specialties', $jobSpecialties);

        if ($matched->isEmpty()) {
            return 0; // no specialty match
        }

        // take highest experience among matched specialties
        $nurseExperience = $matched->max('assistent_level');

        if ($job->experience_level == 0) {
            return $weight;
        }

        $ratio = min($nurseExperience / $job->experience_level, 1);
        return $ratio * $weight;
    }

}
