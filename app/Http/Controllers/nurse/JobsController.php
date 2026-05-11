<?php

namespace App\Http\Controllers\nurse;
use App\Http\Requests\AddnewsletterRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Log;
use App\Services\User\AuthServices;
use App\Http\Requests\UserUpdateProfile;
use App\Http\Requests\UserChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;
use Helpers;
use Mail;
use Validator;
use DB;
use URL;
use Session;
use File;
use App\Services\Admins\SpecialityServices;
use Illuminate\Support\Facades\Storage;
use App\Models\SavedSearches;
use App\Models\JobsModel;
use App\Models\RegisteredProfile;
use App\Models\User;
use App\Models\Profession;
use App\Services\User\NurseJobMatchService;

class JobsController extends Controller{

    public function index(Request $request,NurseJobMatchService $matchService)
    {
        $this->ensureDefaultSearch();
        $data['employeement_type_data'] = DB::table("employeement_type_preferences")->where("sub_prefer_id", 0)->get();
        $data['shift_type_data'] = DB::table("work_shift_preferences")->where("shift_id", 0)->where("sub_shift_id", NULL)->get();
        $data['employee_positions'] = DB::table("employee_positions")->where("subposition_id", 0)->get();
        $data['benefits_preferences'] = DB::table("benefits_preferences")->where("subbenefit_id", 0)->get();
        $data['work_environment_data'] = DB::table("work_enviornment_preferences")
            ->where("sub_env_id", 0)
            ->where("sub_envp_id", 0)
            ->get();
        $data['work_shift_data'] = DB::table("work_shift_preferences")
            ->where("shift_id", 0)
            ->where("sub_shift_id", NULL)
            ->get();
        $data['type_of_nurse'] = DB::table("practitioner_type")
            ->where("parent", 0)
            ->get();
        $data['speciality'] = DB::table("speciality")
            ->where("parent", 0)
            ->get();
        $user_detail = Auth::guard('nurse_middle')->user();
        $user_id = $user_detail->id;

        $nurseTypes = DB::table('profession_data')->where('user_id', $user_id)->pluck('nurse_data')->toArray();
        $specialityTypes = DB::table('profession_data')->where('user_id', $user_id)->pluck('specialties')->toArray();

        // echo "<pre>";
        // print_r($nurseTypes);
        // die;
        $data['work_preferences_data'] = DB::table("work_preferences")
            ->where("user_id", $user_id)
            ->first();

        $workPreferences = $data['work_preferences_data'] ;
        $sectorStatus = null;
        if (!empty($workPreferences->sector_preferences)) {

            if ($workPreferences->sector_preferences == "Public & Government") {
                $sectorStatus = 1; // Public + Private
            } elseif ($workPreferences->sector_preferences == "Private") {
                $sectorStatus = 2; // Public
            } elseif ($workPreferences->sector_preferences == "Public Government & Private") {
                $sectorStatus = 3; // Private
            }
        }

        if ($workPreferences) {
            DB::table('saved_searches')->updateOrInsert(
                ['user_id' => $user_id, 'status_my_preference'=> 1], // condition

                [
                    'name'                      => "My Preferences",
                    'filter_sector'             => $sectorStatus,
                    'filter_work_environment'   => $workPreferences->work_environment_preferences,
                    'filter_employment_type'    => $workPreferences->emptype_preferences,
                    'filter_work_shift'         => $workPreferences->work_shift_preferences,
                    'filter_employee_positions' => $workPreferences->position_preferences,
                    'filter_benefits_preferences' => $workPreferences->benefits_preferences,

                    'filter_salary_min' => !empty($workPreferences->salary_expectations)
                        ? explode('-', $workPreferences->salary_expectations)[0]
                        : null,

                    'filter_salary_max' => !empty($workPreferences->salary_expectations)
                        ? explode('-', $workPreferences->salary_expectations)[1] ?? null
                        : null,

                    'filter_location_preference' => $workPreferences->prefered_location,

                    'filter_nurse_type' => json_encode($nurseTypes),
                    'filter_speciality' => json_encode($specialityTypes),
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }

        // echo "<pre>";
        // print_r($workPreferences);
        // die;

        $data['saved_searches_data'] = DB::table("saved_searches")
            ->where("user_id", $user_id)
            ->get();
        $data['saved_my_preference'] = DB::table("saved_searches")
            ->where("user_id", $user_id)->where('status_my_preference', 1)
            ->first();


        $today = now();

        foreach ($data['saved_searches_data'] as $search) {
            $filters = json_decode($search->filters, true);

            $query = JobsModel::query();

            // Example: Apply filters dynamically
            if (!empty($filters['sector'])) {
                $query->where('sector', $filters['sector']);
            }

            // Employment type (multiple IDs)
            if (!empty($filters['employment_type'])) {
                $query->whereIn('emplyeement_type', $filters['employment_type']);
            }

            // Work shift (multiple IDs)
            if (!empty($filters['work_shift'])) {
                $query->whereIn('shift_type', $filters['work_shift']);
            }

            // Work environment
            if (!empty($filters['work_environment'])) {
                $query->whereIn('work_environment', $filters['work_environment']);
            }

            // Employee positions
            if (!empty($filters['employee_positions'])) {
                $query->whereIn('emplyeement_positions', $filters['employee_positions']);
            }
            // if (!empty($filters['nurse_type'])) {
            //     $query->whereIn('nurse_type', (array) $filters['nurse_type']);
            // }
            // if (!empty($filters['speciality'])) {
            //     $query->whereIn('speciality', (array) $filters['speciality']);
            // }

            // Only jobs added today
            $query->whereDate('created_at', $today);

            // Count matching jobs
            $data['query_count'] = $query->count();
        }

        // Nurse job search location
        // $residanceCountry = $user_detail->country;
        // $registeredCountries = RegisteredProfile::where('user_id', $user_id)
        //     ->pluck('country_code') // just get codes
        //     ->toArray();

        // // merge residence + registered
        // $allCountries = collect($registeredCountries)
        //     ->push($residanceCountry)
        //     ->unique() // remove duplicates
        //     ->values();
        // $data['registered_countries'] = $allCountries;

        $data['agencies_list'] = JobsModel::where('save_draft', 2)->groupBy('healthcare_id')->get(['healthcare_id']);

        // echo "<pre>";   print_r($data['agencies_list']);die;
        // $data['country_name'] = $country_merge;
        $data['user_data'] = DB::table("users")->where("id", $user_id)->first();

        $today = Carbon::now()->toDateString();
        $chip_filter = trim($request->chip_filter, '"') ?? "";
        $query = DB::table("job_boxes")->where('save_draft', 2);
        if ($chip_filter == 'instant') {
            $query->whereDate('updated_at', $today)
                ->where('main_emp_type', 3);
        } elseif ($chip_filter == 'last_minute') {
            $query->where(function ($q) {
                $q->whereDate('updated_at', Carbon::today())
                    ->orWhereDate('updated_at', Carbon::yesterday());
            })->where('main_emp_type', 3);
        } elseif ($chip_filter == 'immediate') {
            $query->whereBetween('updated_at', [
                Carbon::today(),
                Carbon::today()->addDays(7)
            ])
                ->where('main_emp_type', '!=', 3);
        } elseif ($chip_filter == 'urgent') {
            $query->whereBetween('updated_at', [
                Carbon::today(),
                Carbon::today()->addDays(5)
            ])
                ->where('urgent_hire', 1);
        } elseif($chip_filter == 'new') {
            $query->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('main_emp_type', 3)
                        ->where('updated_at', '>=', Carbon::now()->subDays(5));
                })
                    ->orWhere(function ($sub) {
                        $sub->whereIn('main_emp_type', [1, 2])
                            ->where('updated_at', '>=', Carbon::now()->subDays(15));
                    });
            });
        }else{
            $query->orderBy('created_at', 'desc');
        }

        // $data['jobs'] = $query->paginate(2);
        $data['jobs'] = $query->get();

        //calculate Match percentage
        $user = User::where('id', $user_id)->first();
        $nurseData = Profession::where('user_id', $user_id)->get();
        $nurseTypes = $nurseData->pluck('nurse_data')->toArray();
        $nurseSpecialties = $nurseData->pluck('specialties')->toArray();
        $experience_data = $nurseData->pluck('assistent_level');

        //vaccination 5%
        $nurseVaccines = DB::table('vaccination_front')
            ->where('user_id', $user_id)
            ->pluck('vaccination_id')
            ->toArray();

        //Checks and Clearance 5%
        $eligibility = DB::table('eligibility_to_work')
            ->where('user_id', $user_id)
            ->first();

        $policeCheck = DB::table('police_check')
            ->where('user_id', $user_id)
            ->exists();

        $workingChildren = DB::table('working_children_check')
            ->where('user_id', $user_id)
            ->exists();

        $ndisCheck = DB::table('ndis_screening_check')
            ->where('user_id', $user_id)
            ->exists();

        $preferences = DB::table('work_preferences')
            ->where('user_id', $user_id)
            ->first();

        foreach ($data['jobs']  as $job) {
            $job->match_percentage = $matchService->calculateMatch(
                $user,
                $nurseTypes,
                $nurseSpecialties,
                $experience_data,
                $nurseVaccines,
                $eligibility,
                $policeCheck,
                $workingChildren,
                $ndisCheck,
                $preferences,
                $job
            );
        }

        $data['jobs'] = $data['jobs']->sortByDesc('match_percentage')->values();

        /* PAGINATE */
        $data['jobs'] = new \Illuminate\Pagination\LengthAwarePaginator(
            $data['jobs']->forPage($request->page ?? 1, 2),
            $data['jobs']->count(),
            2,
            $request->page ?? 1,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('nurse.find_jobs')->with($data);
    }

    public function job_details(Request $request){
        $job_id = $request->job_id;
        $data['jobs'] = DB::table("job_boxes")->where("id", $job_id)->first();
        $data['healthcare_data'] = User::where("id",$data['jobs']->healthcare_id)->first();
        $data['state_data'] = DB::table("states")->where("id",$data['jobs']->location_state)->first();

        return view('nurse.job_details')->with($data);
    }

    public function capitalizeFirstTwo($string) {
        $result = '';
        $words = explode(' ', strtolower($string)); // split words, normalize to lowercase
        foreach ($words as $word) {
            $part1 = strtoupper(substr($word, 0, 2)); // first 2 letters uppercase
            $part2 = substr($word, 2);               // rest normal
            $result .= $part1 . $part2 . ' ';
        }
        return trim($result);
    }

    public function getWorkFlexiblityData(Request $request)
    {
        $table_name = $request->table_name;
        $column_name = $request->column_name;
        $main_column_id = $request->main_column_id;
        $column_type = $request->column_type;

        $employeement_type_data = DB::table($table_name)->where($column_name,0)->get()->map(function ($item) {
            return (array) $item;
        })->toArray();
        //print_r($employeement_type_data);die;
        $nested = [];
        foreach($employeement_type_data as $employeement_type){
            $subemp_type = DB::table($table_name)->where($column_name,$employeement_type[$main_column_id])->get();
            $nested[] = [
                'id' => $employeement_type[$main_column_id],
                'name' => $employeement_type[$column_type], // Adjust field names as per your DB
                'sub_types' => $subemp_type->map(function($item) use ($main_column_id, $column_type) {
                    $items = (array)$item;
                    return [
                        'id' => $items[$main_column_id],
                        'name' => $items[$column_type] // Adjust as needed
                    ];
                })
            ];
        }

        $user_id = Auth::guard('nurse_middle')->user()->id;
        $work_preferences_data = DB::table("work_preferences")
            ->where("user_id", $user_id)
            ->first();

        $response = [
            'filters'     => $nested,
            'preferences' => $work_preferences_data,
        ];



        // Convert to JSON (optional)
        $json = json_encode($response, JSON_PRETTY_PRINT);

        return $json;

    }

    public function getWorkEnvironmentData(Request $request)
    {
        $employeement_type_data = DB::table("work_enviornment_preferences")
            ->where("sub_env_id", 0)
            ->where("sub_envp_id", 0)
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->toArray();

        $nested = [];

        foreach ($employeement_type_data as $employeement_type) {
            $subemp_type = DB::table("work_enviornment_preferences")
                ->where("sub_env_id", $employeement_type['prefer_id'])
                ->where("sub_envp_id", 0)
                ->get();

            $nested[] = [
                'id' => $employeement_type['prefer_id'],
                'name' => $employeement_type['env_name'],
                'sub_types' => $subemp_type->map(function ($item) {
                    $items = (array) $item;

                    // Third level: subsub_types
                    $subsub_type = DB::table("work_enviornment_preferences")
                        ->where("sub_envp_id", $items['prefer_id']) // 3rd level based on sub_envp_id
                        ->get()
                        ->map(function ($third) {
                            $third_item = (array) $third;
                            return [
                                'id' => $third_item['prefer_id'],
                                'name' => $third_item['env_name']
                            ];
                        });

                    return [
                        'id' => $items['prefer_id'],
                        'name' => $items['env_name'],
                        'subsub_types' => $subsub_type
                    ];
                })
            ];
        }

        $json = json_encode($nested, JSON_PRETTY_PRINT);

        // Return as JSON
        return $json;
    }
    public function getJobsSorting(Request $request, NurseJobMatchService $matchService)
    {
        // echo "<pre>";print_r($request->all());die;
        $query = DB::table('job_boxes');
        // APPLY SAVED SEARCH (if exists)
        if ($request->has('filters_data')) {

            $filters = $request->filters_data;

            // Sector
            if (!empty($filters['sector'])) {
                $query->whereIn('sector', $filters['sector']);
            }

            // // Employment Type
            if (!empty($filters['emp_type'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['emp_type'] as $id) {
                        $q->orWhereJsonContains('emplyeement_type', $id);
                    }
                });
            }

            // Shift Type
            if (!empty($filters['shift_modal'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['shift_modal'] as $id) {
                        $q->orWhereJsonContains('shift_type', $id);
                    }
                });
            }

            // Work Environment
            if (!empty($filters['work_environment_modals'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['work_environment_modals'] as $id) {
                        $q->orWhereJsonContains('work_environment', $id);
                    }
                });
            }

            // type of nurse
            if (!empty($filters['nurse_type'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['nurse_type'] as $id) {
                        $q->orWhereJsonContains('nurse_type_id', $id);
                    }
                });
            }

            // type of bendfits
            if (!empty($filters['benefits'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['benefits'] as $id) {
                        $q->orWhereJsonContains('benefits', $id);
                    }
                });
            }

            // type of speciality
            if (!empty($filters['speciality'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['speciality'] as $id) {
                        $q->orWhereJsonContains('typeofspeciality', $id);
                    }
                });
            }

            // year of experience
            if (!empty($filters['experience'])) {
                $query->where('experience_level', $filters['experience']);
            }

            if (isset($filters['salary_min']) && isset($filters['salary_max'])) {
                $query->whereBetween('salary', [
                    (int) $filters['salary_min'],
                    (int) $filters['salary_max']
                ]);
            }
        }
        if ($request->search_id) {

            $saved = DB::table('saved_searches')
                ->where('searches_id', $request->search_id)
                ->first();
            // echo "<pre>";  print_r($saved);die;
            if ($saved) {
                // Nurse Type
                if (!empty($saved->filter_nurse_type)) {

                    $nurseTypeIds = json_decode($saved->filter_nurse_type, true);

                    $query->where(function ($q) use ($nurseTypeIds) {
                        foreach ($nurseTypeIds as $id) {
                            $q->orWhereJsonContains('nurse_type_id', $id);
                        }
                    });
                }

                if (!empty($saved->filter_employment_type)) {

                    $nurseTypeIds = json_decode($saved->filter_employment_type, true);

                    $query->where(function ($q) use ($nurseTypeIds) {
                        foreach ($nurseTypeIds as $id) {
                            $q->orWhereJsonContains('emplyeement_type', $id);
                        }
                    });
                }

                // //Benefit
                if (!empty($benefitIds)) {
                    $query->where(function ($q) use ($benefitIds) {
                        foreach ($benefitIds as $id) {
                            $q->orWhereRaw("JSON_SEARCH(
                            JSON_EXTRACT(benefits, '$.*[*]'),'one', ? ) IS NOT NULL
                            ", [$id]);
                        }
                    });
                }

                // //speciality
                if (!empty($saved->filter_speciality)) {

                    $nurseTypeIds = json_decode($saved->filter_speciality, true);

                    $query->where(function ($q) use ($nurseTypeIds) {
                        foreach ($nurseTypeIds as $id) {
                            $q->orWhereJsonContains('typeofspeciality', $id);
                        }
                    });
                }

                // if (!empty($saved->filter_work_shift)) {

                //     $nurseTypeIds = json_decode($saved->filter_work_shift, true);

                //     $query->where(function ($q) use ($nurseTypeIds) {
                //         foreach ($nurseTypeIds as $id) {
                //             $q->orWhereJsonContains('shift_type', $id);
                //         }
                //     });
                // }
                // // Work Environment
                // if (!empty($saved->filter_work_environment)) {

                //     $nurseTypeIds = json_decode($saved->filter_work_environment, true);

                //     $query->where(function ($q) use ($nurseTypeIds) {
                //         foreach ($nurseTypeIds as $id) {
                //             $q->orWhereJsonContains('work_environment', $id);
                //         }
                //     });
                // }
                // // Employee Positions
                // if (!empty($saved->filter_employee_positions)) {

                //     $nurseTypeIds = json_decode($saved->filter_employee_positions, true);

                //     $query->where(function ($q) use ($nurseTypeIds) {
                //         foreach ($nurseTypeIds as $id) {
                //             $q->orWhereJsonContains('emplyeement_positions', $id);
                //         }
                //     });
                // }

                // // Location
                // if (!empty($saved->filter_location_preference)) {
                //     $locations = json_decode($saved->filter_location_preference, true);
                //     $query->whereIn('location_name', $locations);
                // }

                // Sector
                if (!empty($saved->filter_sector)) {
                    $query->where('sector', $saved->filter_sector);
                }

                // Salary Range
                // if (!empty($saved->filter_salary_min)) {
                //     $query->where('salary', '>=', $saved->filter_salary_min);
                // }

                // if (!empty($saved->filter_salary_max)) {
                //     $query->where('salary', '<=', $saved->filter_salary_max);
                // }


                // if (!empty($saved->filter_experience_years)) {
                //     $query->where('experience_level', '>=', $saved->filter_experience_years);
                // }
            }
        }
        // Keyword
        if ($request->keywords) {
            $query->where('job_title', 'LIKE', '%' . $request->keywords . '%');
        }

        // job Start
        $show_job_start = $request->job_start;
        $today = Carbon::now()->toDateString();
        if (!empty($show_job_start)) {
            if ($show_job_start == 'instant') {
                $query = $query->whereDate('updated_at', $today)->where('main_emp_type', 3);
            } elseif ($show_job_start == 'last_minute') {
                $query = $query
                    ->where(function ($query2) {
                        $query2->whereDate('updated_at', Carbon::today())
                            ->orWhereDate('updated_at', Carbon::yesterday());
                    })
                    ->where('main_emp_type', 3);
            } elseif ($show_job_start == 'immediate') {
                $query = $query
                    ->whereBetween('updated_at', [Carbon::today(), Carbon::today()->addDays(7)])
                    ->where('main_emp_type', '!=', 3);
            }
        }

        // Agency
        if ($request->agency) {
            $agencyIds = is_array($request->agency)
                ? $request->agency
                : [$request->agency];

            $query->whereIn('healthcare_id', $agencyIds);
        }

        $jobs = $query->where("save_draft", 2)->get();
        // $jobs = $query->get();
        // print_r($jobs);die;
        //calculate Match percentage
        $user_id = Auth::guard('nurse_middle')->user()->id;

        $user = User::where('id', $user_id)->first();
        $nurseData = Profession::where('user_id', $user_id)->get();
        $nurseTypes = $nurseData->pluck('nurse_data')->toArray();
        $nurseSpecialties = $nurseData->pluck('specialties')->toArray();
        $experience_data = $nurseData->pluck('assistent_level');

        //vaccination 5%
        $nurseVaccines = DB::table('vaccination_front')
            ->where('user_id', $user_id)
            ->pluck('vaccination_id')
            ->toArray();

        //Checks and Clearance 5%
        $eligibility = DB::table('eligibility_to_work')
            ->where('user_id', $user_id)
            ->first();

        $policeCheck = DB::table('police_check')
            ->where('user_id', $user_id)
            ->exists();

        $workingChildren = DB::table('working_children_check')
            ->where('user_id', $user_id)
            ->exists();

        $ndisCheck = DB::table('ndis_screening_check')
            ->where('user_id', $user_id)
            ->exists();

        $preferences = DB::table('work_preferences')
            ->where('user_id', $user_id)
            ->first();

        foreach ($jobs  as $job) {
            $job->match_percentage = $matchService->calculateMatch(
                $user,
                $nurseTypes,
                $nurseSpecialties,
                $experience_data,
                $nurseVaccines,
                $eligibility,
                $policeCheck,
                $workingChildren,
                $ndisCheck,
                $preferences,
                $job
            );
        }

        //Sorting
        if ($request->sort_name == 1) {
            $jobs = $jobs->sortByDesc('match_percentage')->values();
        } elseif ($request->sort_name == 2) {
            $jobs = $jobs->sortByDesc('updated_at')->values();
        } elseif ($request->sort_name == 3) {
            $jobs = $jobs->sortByDesc(function ($job) {
                if ($job->main_emp_type == 1) {
                    return $job->per_salary_max ?? 0;
                } elseif ($job->main_emp_type == 2) {
                    return $job->fixed_term_salary_max ?? 0;
                } elseif ($job->main_emp_type == 3) {
                    return $job->temporary_salary_max ?? 0;
                }
                return 0;
            })->values();
        } elseif ($request->sort_name == 4) {
            $nurseLat  = $user->city_lat;
            $nurseLong = $user->city_long;

            $jobs = $jobs->map(function ($job) use ($nurseLat, $nurseLong) {

                if ($job->city_lat && $job->city_long) {

                    $earthRadius = 6371; // KM

                    $latFrom = deg2rad($nurseLat);
                    $lonFrom = deg2rad($nurseLong);
                    $latTo   = deg2rad($job->city_lat);
                    $lonTo   = deg2rad($job->city_long);

                    $latDelta = $latTo - $latFrom;
                    $lonDelta = $lonTo - $lonFrom;

                    $angle = 2 * asin(sqrt(
                        pow(sin($latDelta / 2), 2) +
                            cos($latFrom) * cos($latTo) *
                            pow(sin($lonDelta / 2), 2)
                    ));

                    $distance = $earthRadius * $angle;
                } else {
                    $distance = 999999;
                }

                $job->distance = $distance;

                return $job;
            })->sortBy('distance')->values();
        } elseif ($request->sort_name == 5) {
            $jobs = $jobs->whereBetween('updated_at', [Carbon::today(), Carbon::today()->addDays(5)])
                ->where('urgent_hire', 1);
        } elseif ($request->sort_name == 6) {
            $today = Carbon::today();

            $jobs = $jobs->filter(function ($job) use ($today) {
                return !empty($job->custom_expiry_date) &&
                    Carbon::parse($job->custom_expiry_date)->gte($today->startOfDay());
            })
                ->sortBy(function ($job) {
                    return Carbon::parse($job->custom_expiry_date);
                })
                ->values();
        }

        $jobs = new \Illuminate\Pagination\LengthAwarePaginator(
            $jobs->forPage($request->page ?? 1, 2),
            $jobs->count(),
            2,
            $request->page ?? 1
        );
        if ($jobs->count() == 0) {
            return response()->json([
                'status' => false,
                'html' => ''
            ]);
        }
        return response()->json([
            'status' => true,
            'html' => view('nurse.job_filter_data', compact('jobs'))->render()
        ]);
    }

    public function getJobsSorting_old(Request $request,NurseJobMatchService $matchService)
    {
        // echo "<pre>";print_r($request->all());die;
        $query = DB::table('job_boxes');
        // APPLY SAVED SEARCH (if exists)
        if ($request->has('filters_data')) {

            $filters = $request->filters_data;

            // Sector
            if (!empty($filters['sector'])) {
                $query->whereIn('sector', $filters['sector']);
            }

            // // Employment Type
            if (!empty($filters['emp_type'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['emp_type'] as $id) {
                        $q->orWhereJsonContains('emplyeement_type', $id);
                    }
                });
            }

            // Shift Type
            if (!empty($filters['shift_modal'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['shift_modal'] as $id) {
                        $q->orWhereJsonContains('shift_type', $id);
                    }
                });
            }

            // Work Environment
            if (!empty($filters['work_environment_modals'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['work_environment_modals'] as $id) {
                        $q->orWhereJsonContains('work_environment', $id);
                    }
                });
            }

            // type of nurse
            if (!empty($filters['nurse_type'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['nurse_type'] as $id) {
                        $q->orWhereJsonContains('nurse_type_id', $id);
                    }
                });
            }

            // type of bendfits
            if (!empty($filters['benefits'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['benefits'] as $id) {
                        $q->orWhereJsonContains('benefits', $id);
                    }
                });
            }

            // type of speciality
            if (!empty($filters['speciality'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['speciality'] as $id) {
                        $q->orWhereJsonContains('typeofspeciality', $id);
                    }
                });
            }

            // year of experience
            if (!empty($filters['experience'])) {
                $query->where('experience_level', $filters['experience']);
            }

            if (isset($filters['salary_min']) && isset($filters['salary_max'])) {
                $query->whereBetween('salary', [
                    (int) $filters['salary_min'],
                    (int) $filters['salary_max']
                ]);
            }
        }
        if ($request->search_id) {

            $saved = DB::table('saved_searches')
                ->where('searches_id', $request->search_id)
                ->first();
            // echo "<pre>";  print_r($saved);die;
            if ($saved) {
                // Nurse Type
                if (!empty($saved->filter_nurse_type)) {

                    $nurseTypeIds = json_decode($saved->filter_nurse_type, true);

                    $query->where(function ($q) use ($nurseTypeIds) {
                        foreach ($nurseTypeIds as $id) {
                            $q->orWhereJsonContains('nurse_type_id', $id);
                        }
                    });
                }

                if (!empty($saved->filter_employment_type)) {

                    $nurseTypeIds = json_decode($saved->filter_employment_type, true);

                    $query->where(function ($q) use ($nurseTypeIds) {
                        foreach ($nurseTypeIds as $id) {
                            $q->orWhereJsonContains('emplyeement_type', $id);
                        }
                    });
                }

                // //Benefit
                if (!empty($benefitIds)) {
                    $query->where(function ($q) use ($benefitIds) {
                        foreach ($benefitIds as $id) {
                            $q->orWhereRaw("JSON_SEARCH(
                            JSON_EXTRACT(benefits, '$.*[*]'),'one', ? ) IS NOT NULL
                            ", [$id]);
                        }
                    });
                }

                // //speciality
                if (!empty($saved->filter_speciality)) {

                    $nurseTypeIds = json_decode($saved->filter_speciality, true);

                    $query->where(function ($q) use ($nurseTypeIds) {
                        foreach ($nurseTypeIds as $id) {
                            $q->orWhereJsonContains('typeofspeciality', $id);
                        }
                    });
                }

                // if (!empty($saved->filter_work_shift)) {

                //     $nurseTypeIds = json_decode($saved->filter_work_shift, true);

                //     $query->where(function ($q) use ($nurseTypeIds) {
                //         foreach ($nurseTypeIds as $id) {
                //             $q->orWhereJsonContains('shift_type', $id);
                //         }
                //     });
                // }
                // // Work Environment
                // if (!empty($saved->filter_work_environment)) {

                //     $nurseTypeIds = json_decode($saved->filter_work_environment, true);

                //     $query->where(function ($q) use ($nurseTypeIds) {
                //         foreach ($nurseTypeIds as $id) {
                //             $q->orWhereJsonContains('work_environment', $id);
                //         }
                //     });
                // }
                // // Employee Positions
                // if (!empty($saved->filter_employee_positions)) {

                //     $nurseTypeIds = json_decode($saved->filter_employee_positions, true);

                //     $query->where(function ($q) use ($nurseTypeIds) {
                //         foreach ($nurseTypeIds as $id) {
                //             $q->orWhereJsonContains('emplyeement_positions', $id);
                //         }
                //     });
                // }

                // // Location
                // if (!empty($saved->filter_location_preference)) {
                //     $locations = json_decode($saved->filter_location_preference, true);
                //     $query->whereIn('location_name', $locations);
                // }

                // Sector
                if (!empty($saved->filter_sector)) {
                    $query->where('sector', $saved->filter_sector);
                }

                // Salary Range
                // if (!empty($saved->filter_salary_min)) {
                //     $query->where('salary', '>=', $saved->filter_salary_min);
                // }

                // if (!empty($saved->filter_salary_max)) {
                //     $query->where('salary', '<=', $saved->filter_salary_max);
                // }


                // if (!empty($saved->filter_experience_years)) {
                //     $query->where('experience_level', '>=', $saved->filter_experience_years);
                // }
            }
        }
        // Keyword
        if ($request->keywords) {
            $query->where('job_title', 'LIKE', '%' . $request->keywords . '%');
        }

        // Location
        if (!empty($request->locations)) {
            $query->whereIn('location_country', $request->locations);
        }

        // Agency
        if ($request->agency) {
            $query->where('healthcare_id', $request->agency);
        }

        // SORTING
        if ($request->sort_name == 2) {
            $query->orderBy('id', 'desc');
        } elseif ($request->sort_name == 5) {
            $query->orderBy('urgent_hire', 'desc');
        } elseif ($request->sort_name == 7) {
            $query->orderBy('application_submission_date', 'asc');
        }

        $jobs = $query->where("save_draft", 2)->paginate(2);
        // $jobs = $query->get();
        // print_r($jobs);die;
        //calculate Match percentage
        $user_id = Auth::guard('nurse_middle')->user()->id;

        $user = User::where('id', $user_id)->first();
        $nurseData = Profession::where('user_id', $user_id)->get();
        $nurseTypes = $nurseData->pluck('nurse_data')->toArray();
        $nurseSpecialties = $nurseData->pluck('specialties')->toArray();
        $experience_data = $nurseData->pluck('assistent_level');

        //vaccination 5%
        $nurseVaccines = DB::table('vaccination_front')
            ->where('user_id', $user_id)
            ->pluck('vaccination_id')
            ->toArray();

        //Checks and Clearance 5%
        $eligibility = DB::table('eligibility_to_work')
            ->where('user_id', $user_id)
            ->first();

        $policeCheck = DB::table('police_check')
            ->where('user_id', $user_id)
            ->exists();

        $workingChildren = DB::table('working_children_check')
            ->where('user_id', $user_id)
            ->exists();

        $ndisCheck = DB::table('ndis_screening_check')
            ->where('user_id', $user_id)
            ->exists();

        $preferences = DB::table('work_preferences')
            ->where('user_id', $user_id)
            ->first();

        foreach ($jobs  as $job) {
            $job->match_percentage = $matchService->calculateMatch(
                $user,
                $nurseTypes,
                $nurseSpecialties,
                $experience_data,
                $nurseVaccines,
                $eligibility,
                $policeCheck,
                $workingChildren,
                $ndisCheck,
                $preferences,
                $job
            );
        }
        if ($jobs->count() == 0) {
            return response()->json([
                'status' => false,
                'html' => ''
            ]);
        }
        return response()->json([
            'status' => true,
            'html' => view('nurse.job_filter_data', compact('jobs'))->render()
        ]);
    }

    public function getNurseData(Request $request)
    {
        $nurse_id = $request->nurse_id;
        $nurse_data = DB::table("practitioner_type")->where("parent",$nurse_id)->get();

        $ndatas = array();
        foreach($nurse_data as $ndata){

            $nsubarr = array();
            $get_nurse_count = DB::table("practitioner_type")->where("parent",$ndata->id)->get();

            foreach($get_nurse_count as $get_nurse){
                $nsubarr[] = array("id"=>$get_nurse->id,"name"=>$get_nurse->name,"parent"=>$get_nurse->parent);
            }

            $ndatas[] = array("id"=>$ndata->id,"name"=>$ndata->name,"parent"=>$ndata->parent,"get_nurse_count"=>count($get_nurse_count),"get_nurse"=>$nsubarr);
        }
        return json_encode($ndatas);
    }

    public function getSpecialityData(Request $request)
    {
        $specality_id = $request->speciality_id;
        $specality_data = DB::table("speciality")->where("parent",$specality_id)->get();

        $specdatas = array();
        foreach($specality_data as $specdata){

            $specsubarr = array();
            $get_spec_count = DB::table("speciality")->where("parent",$specdata->id)->get();

            foreach($get_spec_count as $get_spec){
                $specsubarr[] = array("id"=>$get_spec->id,"name"=>$get_spec->name,"parent"=>$get_spec->parent);
            }

            $specdatas[] = array("id"=>$specdata->id,"name"=>$specdata->name,"parent"=>$specdata->parent,"get_spec_count"=>count($get_spec_count),"get_spec"=>$specsubarr);
        }
        return json_encode($specdatas);
    }

    public function getFilterData(Request $request){
        $filter_name = $request->filter_name;
        $searchValues = $request->selectedValues;
        $selectedValues = $request->selectedValues;
        //print_r($selectedValues);die;


        if($filter_name == "Employment Type"){
            $data['jobs'] = DB::table("job_boxes")->where(function($query) use ($selectedValues) {
                foreach ($selectedValues as $id) {
                    $query->orWhereJsonContains('emplyeement_type', (string) $id);
                }
            })->get();

        }

        if($filter_name == "Position"){
            $data['jobs'] = DB::table("job_boxes")->where(function($query) use ($selectedValues) {
                foreach ($selectedValues as $id) {
                    $query->orWhereJsonContains('emplyeement_positions', (string) $id);
                }
            })->get();
        }

        if($filter_name == "Benefits"){
            $data['jobs'] = DB::table("job_boxes")->where(function($query) use ($selectedValues) {
                foreach ($selectedValues as $id) {
                    $query->orWhereJsonContains('benefits', (string) $id);
                }
            })->get();
        }
        //print_r($jobs);

        if($filter_name == "sector"){
            $data['jobs'] = DB::table("job_boxes")->whereIn("sector",$selectedValues)->get();
        }
        //print_r($data);die;
        return view("nurse.job_filter_data")->with($data);

    }

    public function getExperienceData(Request $request){
        $experience = $request->experience;

        $data['jobs'] = DB::table("job_boxes")->where("experience_level",$experience)->get();

        return view("nurse.job_filter_data")->with($data);
    }

    public function getFilterNurseData(Request $request){
        $nurse_data = $request->nurse_data;

        $data['jobs'] = DB::table('job_boxes')
        ->where(function($query) use ($nurse_data) {
            foreach ($nurse_data as $value) {
                $query->orWhere('nurse_type', 'LIKE', '%"'.$value.'"%');
            }
        })
        ->get();

        return view("nurse.job_filter_data")->with($data);
    }

    public function getFilterSpecialityData(Request $request){
        $speciality_data = $request->speciality_data;

        $data['jobs'] = DB::table('job_boxes')
        ->where(function($query) use ($speciality_data) {
            foreach ($speciality_data as $value) {
                $query->orWhere('typeofspeciality', 'LIKE', '%"'.$value.'"%');
            }
        })
        ->get();

        return view("nurse.job_filter_data")->with($data);
    }

    public function updateSectorData(Request $request){
        $sector_data = $request->sector_data;

        $user_id = Auth::guard("nurse_middle")->user()->id;

        $updateWorkPreferencesFlexiblity = DB::table("work_preferences")->where("user_id",$user_id)->update(['sector_preferences'=>$sector_data]);
    }

    public function fetchJobFilters(Request $request)
    {
        $mode = $request->mode;
        $user = Auth::guard('nurse_middle')->user();
        $user_id = $user->id;

        if ($mode == 'prefill') {

            $workPreferences = DB::table("work_preferences")
                ->where("user_id", $user_id)
                ->first();

            $nurseTypes = DB::table('profession_data')
                ->where('user_id', $user_id)
                ->pluck('nurse_data')
                ->toArray();

            $specialityTypes = DB::table('profession_data')
                ->where('user_id', $user_id)
                ->pluck('specialties')
                ->toArray();

            $sectorStatus = null;

            if (!empty($workPreferences->sector_preferences)) {

                if ($workPreferences->sector_preferences == "Public & Government") {
                    $sectorStatus = 1;
                } elseif ($workPreferences->sector_preferences == "Private") {
                    $sectorStatus = 2;
                } elseif ($workPreferences->sector_preferences == "Public Government & Private") {
                    $sectorStatus = 3;
                }
            }

            if ($workPreferences) {

                DB::table('saved_searches')->updateOrInsert(
                    ['user_id' => $user_id, 'status_my_preference' => 1],
                    [
                        // 'name' => "My Preferences",
                        'filter_sector' => $sectorStatus,
                        'filter_work_environment' => $workPreferences->work_environment_preferences,
                        'filter_employment_type' => $workPreferences->emptype_preferences,
                        'filter_work_shift' => $workPreferences->work_shift_preferences,
                        'filter_employee_positions' => $workPreferences->position_preferences,
                        'filter_benefits_preferences' => $workPreferences->benefits_preferences,

                        'filter_salary_min' => !empty($workPreferences->salary_expectations)
                            ? explode('-', $workPreferences->salary_expectations)[0]
                            : null,

                        'filter_salary_max' => !empty($workPreferences->salary_expectations)
                            ? explode('-', $workPreferences->salary_expectations)[1] ?? null
                            : null,

                        'filter_location_preference' => $workPreferences->prefered_location,

                        'filter_nurse_type' => json_encode($nurseTypes),
                        'filter_speciality' => json_encode($specialityTypes),

                        'updated_at' => now(),
                    ]
                );

                $preferences = DB::table('saved_searches')
                    ->where('user_id', $user_id)
                    ->where('status_my_preference', 1)
                    ->first();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Filters loaded from your registered preferences.',
                    'data' => $preferences
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Work preferences not found.'
            ]);
        }

        if ($mode == 'clear') {

            DB::table('saved_searches')
                ->where('user_id', $user_id)
                ->where('status_my_preference', 1)
                ->update([
                    'filter_sector' => null,
                    'filter_work_environment' => null,
                    'filter_employment_type' => null,
                    'filter_work_shift' => null,
                    'filter_employee_positions' => null,
                    'filter_benefits_preferences' => null,
                    'filter_salary_min' => null,
                    'filter_salary_max' => null,
                    'filter_location_preference' => null,
                    'filter_nurse_type' => null,
                    'filter_speciality' => null,
                    'updated_at' => now(),
                ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Filters cleared successfully.'
            ]);

        }
    }
    public function applyJobs(Request $request)
    {
        // print_r($request->all());
        // die;
        // $request->validate([
        //     'user_id' => 'required',
        //     'job_id'  => 'required'
        // ]);

        $user_id = $request->user_id;
        $job_id  = $request->job_id;

        $candidate = User::where("id",$user_id)->first();

        // 🔹 Check if already applied
        $alreadyApplied = DB::table('nurse_applications')
            ->where('nurse_id', $user_id)
            ->where('job_id', $job_id)
            ->exists();


        if ($alreadyApplied) {
            return response()->json([
                'status' => false,
                'message' => 'You have already applied for this job.'
            ]);
        }

        // 🔹 Get job details from job_boxes table
        $job = DB::table('job_boxes')->where('id', $job_id)->first();

        $healthcare = User::find($job->healthcare_id);
        $healthcare_notification = DB::table("users")->where("id",$job->healthcare_id)->first();

        // Send email if healthcare has email notifications ON
        if ($healthcare && $healthcare_notification->email_notification == 1) {
            $htmlBody = view('email.new_job_application', [
                'candidate' => $candidate,
                'job' => $job,
                'healthcare' => $healthcare
            ])->render();

            \App\Helpers\ZeptoMailHelper::sendMail(
                $healthcare->email,
                "New Job Application Received - Mediqa",
                $htmlBody
            );
        }

        // print_r($job);die;

        if (!$job) {
            return response()->json([
                'status' => false,
                'message' => 'Job not found.'
            ]);
        }

        // 🔹 Insert into nurse_applications table
        $applicationId = DB::table('nurse_applications')->insertGetId([
            'nurse_id'     => $user_id,
            'job_id'       => $job->id,
            'employer_id'  => $job->healthcare_id ?? null,
            'job_title'    => $job->job_title ?? null, // change if you have title column
            'status'       => 1, // 1 = submitted
            'applied_at'   => now(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        if ($applicationId) {
            // 🔹 Auto-create chat conversation for this application
            try {
                $nurse = \App\Models\User::find($user_id);
                $healthcare = \App\Models\User::find($job->healthcare_id);

                if ($nurse && $healthcare) {
                    // Check if conversation already exists
                    $existingConversation = \App\Models\Conversation::where('nurse_id', $nurse->id)
                        ->where('healthcare_id', $healthcare->id)
                        ->where('job_id', $job_id)
                        ->first();

                    if (!$existingConversation) {
                        // Create new conversation
                        $conversation = \App\Models\Conversation::create([
                            'subject' => 'Job Application: ' . ($job->job_title ?? 'Position'),
                            'job_id' => $job_id,
                            'nurse_id' => $nurse->id,
                            'healthcare_id' => $healthcare->id,
                            'status' => 'active',
                        ]);

                        // Create initial system message
                        \App\Models\Message::create([
                            'conversation_id' => $conversation->id,
                            'sender_id' => $nurse->id,
                            'sender_type' => 'nurse',
                            'message' => 'You have submitted your application for the position of ' . ($job->job_title ?? 'this role') . '. The healthcare facility will review your application.',
                            'message_type' => 'system',
                        ]);

                        // Create participants
                        \App\Models\ConversationParticipant::create([
                            'conversation_id' => $conversation->id,
                            'user_id' => $nurse->id,
                        ]);

                        \App\Models\ConversationParticipant::create([
                            'conversation_id' => $conversation->id,
                            'user_id' => $healthcare->id,
                        ]);
                    }
                }
            } catch (\Exception $e) {
                // Log error but don't fail the application
                \Log::error('Failed to create chat conversation: ' . $e->getMessage());
            }

            return response()->json([
                'status' => true,
                'message' => 'Job applied successfully. You can now chat with the healthcare facility.',
                'application_id' => $applicationId
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong.'
        ]);
    }
    //     $apply = DB::table('nurse_applications')->insert([
    //         'nurse_id'     => $user_id,
    //         'job_id'       => $job->id,
    //         'employer_id'  => $job->healthcare_id ?? null,
    //         'job_title'    => $job->job_title ?? null, // change if you have title column
    //         'status'       => 1, // 1 = submitted
    //         'applied_at'   => now(),
    //         'created_at'   => now(),
    //         'updated_at'   => now(),
    //     ]);

    //     if ($apply) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Job applied successfully.'
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => false,
    //         'message' => 'Something went wrong.'
    //     ]);
    // }

    // public function addSavedSearches(Request $request){

    //     $user_id = Auth::guard('nurse_middle')->user()->id;
    //     $search_id = $request->search_id;
    //     $filter_location = $request->edit_filter_location;
    //     $filter_shift = $request->edit_filter_shift;
    //     $filter_preview = $request->edit_filter_preview;
    //     $minSalary1 = $request->minSalary1;
    //     $maxSalary1 = $request->maxSalary1;
    //     $year_experience = $request->year_experience;
    //     $edit_alert_cap = $request->edit_alert_cap;
    //     $edit_quiet_start = $request->edit_quiet_start;
    //     $edit_quiet_end = $request->edit_quiet_end;
    //     $edit_search_notes = $request->edit_search_notes;
    //     $suggestion_search_name = $request->suggestion_search_name;
    //     $search_type = $request->search_type;
    //     $alert_frequency = $request->alert_frequency;
    //     $delivery_method = $request->delivery_method;
    //     $filters = $request->filters;
    //     $date = date("Y-m-d H:i:s");

    //     $totalSearches = SavedSearches::where('user_id', $user_id)->count();


    //     if($search_id){
    //         $oldSearch = SavedSearches::find($search_id);
    //         //$oldSearch->name = $search_name;
    //         $oldSearch->alert = $alert_frequency;
    //         $oldSearch->delivery = $delivery_method;
    //         $oldSearch->filters = $filters;
    //         $oldSearch->salary_min = $minSalary1;
    //         $oldSearch->salary_max = $maxSalary1;
    //         $oldSearch->experience = $year_experience;
    //         // $oldSearch->location = $filter_location;
    //         // $oldSearch->shift = $filter_shift;
    //         // $oldSearch->preview_count = $filter_preview;
    //         // $oldSearch->daily_cap = $edit_alert_cap;
    //         $oldSearch->quite_hours_start = $edit_quiet_start;
    //         $oldSearch->quite_hours_end = $edit_quiet_end;
    //         $oldSearch->notes = $edit_search_notes;
    //         $oldSearch->updated_at = $date;
    //         $run = $oldSearch->save();
    //         $lastInsertedId = $oldSearch->searches_id;
    //     }else{
    //         $saved_searches = new SavedSearches();
    //         $saved_searches->user_id = $user_id;
    //         //$saved_searches->name = $search_name;
    //         $saved_searches->type = $search_type;
    //         $saved_searches->alert = $alert_frequency;
    //         $saved_searches->delivery = $delivery_method;
    //         $saved_searches->filters = $suggestion_search_name;
    //         $saved_searches->created_at = $date;
    //         $run = $saved_searches->save();

    //         $lastInsertedId = $saved_searches->id;
    //     }


    //     if ($run) {
    //         $json['status'] = 1;
    //         $json['id'] = $lastInsertedId;
    //     } else {
    //         $json['status'] = 0;

    //     }

    //     echo json_encode($json);
    // }

    public function addSavedSearches(Request $request)
    {
        // print_r($request->all());die;
        $user_id = Auth::guard('nurse_middle')->user()->id;

        // 1️⃣ Build filters JSON from form
        $filters = [
            'sector' => $request->edit_sector,

            'employment_type' => $request->employment_type ?? [],
            'work_shift' => $request->work_shift ?? [],
            'work_environment' => $request->work_environment ?? [],
            'employee_positions' => $request->employee_positions ?? [],
            'benefits_preferences' => $request->benefits_preferences ?? [],
            'nurse_type' => $request->nurse_type ?? [],
            'speciality' => $request->speciality ?? [],

            'location_preference' => $request->edit_location,

            'experience_years' => $request->year_experience,

            'salary' => [
                'min' => $request->minSalary1,
                'max' => $request->maxSalary1,
            ],
        ];

        // 2️⃣ Update existing search
        if ($request->search_id) {

            $savedSearch = SavedSearches::where('searches_id', $request->search_id)
                ->where('user_id', $user_id)
                ->firstOrFail();

            $existingFilters = $savedSearch->filters ?? [];

            $newFilters = [
                'sector' => $request->edit_sector,
                'employment_type' => $request->employment_type,
                'work_shift' => $request->work_shift,
                'work_environment' => $request->work_environment,
                'employee_positions' => $request->employee_positions,
                'benefits_preferences' => $request->benefits_preferences,
                'nurse_type' => $request->nurse_type,
                'speciality' => $request->speciality,
                'location_preference' => $request->edit_location,
                'experience_years' => $request->year_experience,
                'salary' => [
                    'min' => $request->minSalary1,
                    'max' => $request->maxSalary1,
                ],
            ];

            // Merge only non-null values
            $savedSearch->filters = array_merge(
                $existingFilters,
                array_filter($newFilters, fn($v) => $v !== null)
            );

            $savedSearch->alert = $request->alert_frequency;
            $savedSearch->delivery = $request->delivery_method;
            $savedSearch->name = $request->search_name;
            $savedSearch->notes = $request->edit_search_notes;
            $savedSearch->quite_hours_start = $request->edit_quiet_start;
            $savedSearch->quite_hours_end = $request->edit_quiet_end;

            $savedSearch->filter_sector = $request->edit_sector;
            $savedSearch->filter_employment_type = $request->employment_type;
            $savedSearch->filter_work_shift = $request->work_shift;
            $savedSearch->filter_work_environment = $request->work_environment;
            $savedSearch->filter_employee_positions = $request->employee_positions;
            $savedSearch->filter_benefits_preferences = $request->benefits_preferences;
            $savedSearch->filter_nurse_type = $request->nurse_type;
            $savedSearch->filter_speciality = $request->speciality;
            $savedSearch->filter_location_preference = $request->edit_location;
            $savedSearch->filter_experience_years = $request->year_experience;
            $savedSearch->filter_salary_min = $request->minSalary1;
            $savedSearch->filter_salary_max = $request->maxSalary1;

            $savedSearch->save();

            $id = $savedSearch->searches_id;
            // echo "hi"; die;
        } else {
            // echo "bye";
            // die;
            // print_r($request->all());die;
            $savedSearch = SavedSearches::create([
                'user_id' => $user_id,
                'type' => $request->search_type,
                'name' => $request->search_name,
                'alert' => $request->alert_frequency,
                'delivery' => $request->delivery_method,
                'filters' => $filters, // ✅ ARRAY
            ]);

            $id = $savedSearch->searches_id;
        }

        return response()->json([
            'status' => 1,
            'id' => $id
        ]);
    }

    public function deleteSearchJobsData(Request $request){
        $searches_id = $request->searches_id;
        $delete_search_data = DB::table("saved_searches")->where("searches_id",$searches_id)->delete();


        echo $delete_search_data;
    }

   public function duplicateSearch(Request $request)
    {

        $oldSearch = SavedSearches::where('searches_id', $request->searches_id)->first();
        $user_id = Auth::guard('nurse_middle')->user()->id;

        if (!$oldSearch) {
            return response()->json(['success' => false, 'message' => 'Original search not found']);
        }

        $duplicate = new SavedSearches();
        $duplicate->user_id = $user_id;
        $duplicate->name = $request->name;
        $duplicate->filters = $request->filters;
        $duplicate->filter_nurse_type = $request->filter_nurse_type;
        $duplicate->filter_speciality = $request->speciality_type;
        $duplicate->filter_benefits_preferences = $request->benefits_type;
        $duplicate->filter_employment_type = $request->employeement_type;
        $duplicate->filter_sector = $request->sector_type;
        $duplicate->filter_work_environment = $request->environment_type;
        $duplicate->alert = $request->alert;
        //$duplicate->delivery = $request->delivery;
        $duplicate->created_at = now();
        $duplicate->save();

        return response()->json([
            'success' => true,
            'new_id' => $duplicate->id
        ]);
    }

    public function getEditSearchData(Request $request)
    {

        $SearchData = SavedSearches::where('searches_id', $request->id)->first();

        $search_data = json_encode($SearchData);

        //print_r($search_data);

        return $search_data;
    }

    public function deleteMultipleSearches(Request $request)
    {
        if (!$request->has('ids')) {
            return response()->json(['status' => 'error', 'message' => 'No IDs provided']);
        }

        SavedSearches::whereIn('searches_id', $request->ids)->delete();

        return response()->json(['status' => 'success']);
    }

    public function deleteSingleSearch(Request $request)
    {
        SavedSearches::where('searches_id', $request->id)->delete();

        return response()->json(['status' => 'success']);
    }

    public function ensureDefaultSearch()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;

        $exists = SavedSearches::where('user_id', $user_id)
            ->where('type', 'dynamic')
            ->where('name', 'My Preferences')
            ->first();

        if (!$exists) {
            SavedSearches::create([
                'user_id' => $user_id,
                'name' => 'My Preferences',
                'type' => 'dynamic',
                'alert' => 'Off'
            ]);
        }
    }

   public function getEmpDataSearch(Request $request)
    {
        $id = $request->sub_prefer_id;
        $filterType = $request->filter_type;

        $response = $this->getFilterDataRecursive($filterType, $id);

        return response()->json($response);
    }

    private function getFilterDataRecursive($filterType, $parentId)
    {
        switch ($filterType) {
            case 'employment_type':
                $main = DB::table('employeement_type_preferences')
                            ->where('emp_prefer_id', $parentId)
                            ->first();

                $subs = DB::table('employeement_type_preferences')
                            ->where('sub_prefer_id', $parentId)
                            ->get();

                $subtypes = [];
                foreach ($subs as $s) {
                    $subtypes[] = [
                        'id' => $s->emp_prefer_id,
                        'name' => $s->emp_type,
                        'subtypes' => $this->getFilterDataRecursive('employment_type', $s->emp_prefer_id)['subtypes'],
                    ];
                }

                return [
                    'main' => [
                        'id' => $main->emp_prefer_id,
                        'name' => $main->emp_type,
                    ],
                    'subtypes' => $subtypes,
                    'has_subtypes' => count($subtypes) > 0,
                ];

            case 'work_shift':
                $main = DB::table('work_shift_preferences')
                            ->where('work_shift_id', $parentId)
                            ->first();

                $subs = DB::table('work_shift_preferences')
                        ->where(function ($q) use ($parentId) {
                            // Level 2: direct sub-shifts (no sub_shift_id)
                            $q->where(function ($q2) use ($parentId) {
                                $q2->where('shift_id', $parentId)
                                ->whereNull('sub_shift_id');
                            })
                            // Level 3: sub-shifts under another sub-shift
                            ->orWhere(function ($q3) use ($parentId) {
                                $q3->where('sub_shift_id', $parentId);
                            });
                        })
                        ->get();



                $subtypes = [];
                foreach ($subs as $s) {
                    $subtypes[] = [
                        'id' => $s->work_shift_id,
                        'name' => $s->shift_name,
                        'subtypes' => $this->getFilterDataRecursive('work_shift', $s->work_shift_id)['subtypes'],
                    ];
                }

                return [
                    'main' => [
                        'id' => $main->work_shift_id ?? null,
                        'name' => $main->shift_name ?? null,
                    ],
                    'subtypes' => $subtypes,
                    'has_subtypes' => count($subtypes) > 0,
                ];
            case 'work_environment':
                // Fetch the main parent record
                $main = DB::table('work_enviornment_preferences')
                    ->where('prefer_id', $parentId)
                    ->first();

                $subs = DB::table('work_enviornment_preferences')
                        ->where(function ($q) use ($parentId) {
                            // Level 2: direct sub-environments (sub_env_id = parentId AND sub_envp_id = 0 or null)
                            $q->where(function ($q2) use ($parentId) {
                                $q2->where('sub_env_id', $parentId)
                                ->where(function ($q3) {
                                    $q3->whereNull('sub_envp_id')
                                        ->orWhere('sub_envp_id', 0);
                                });
                            })
                            // Level 3: deeper sub-environments (sub_envp_id = parentId)
                            ->orWhere(function ($q4) use ($parentId) {
                                $q4->where('sub_envp_id', $parentId);
                            });
                        })
                        ->get();


                $subtypes = [];
                foreach ($subs as $s) {
                    $subtypes[] = [
                        'id' => $s->prefer_id,
                        'name' => $s->env_name,
                        'subtypes' => $this->getFilterDataRecursive('work_environment', $s->prefer_id)['subtypes'] ?? [],
                    ];
                }

                // Final structured response
                return [
                    'main' => [
                        'id' => $main->prefer_id ?? null,
                        'name' => $main->env_name ?? null,
                    ],
                    'subtypes' => $subtypes,
                    'has_subtypes' => count($subtypes) > 0,
                ];

            case 'employee_positions':
                $main = DB::table('employee_positions')
                            ->where('position_id', $parentId)
                            ->first();

                $subs = DB::table('employee_positions')
                            ->where('subposition_id', $parentId)
                            ->get();

                $subtypes = [];
                foreach ($subs as $s) {
                    $subtypes[] = [
                        'id' => $s->position_id,
                        'name' => $s->position_name,
                        'subtypes' => $this->getFilterDataRecursive('employee_positions', $s->position_id)['subtypes'],
                    ];
                }

                return [
                    'main' => [
                        'id' => $main->position_id,
                        'name' => $main->position_name,
                    ],
                    'subtypes' => $subtypes,
                    'has_subtypes' => count($subtypes) > 0,
                ];

            case 'benefits_preferences':
                $main = DB::table('benefits_preferences')
                            ->where('benefits_id', $parentId)
                            ->first();

                $subs = DB::table('benefits_preferences')
                            ->where('subbenefit_id', $parentId)
                            ->get();

                $subtypes = [];
                foreach ($subs as $s) {
                    $subtypes[] = [
                        'id' => $s->benefits_id,
                        'name' => $s->benefits_name,
                        'subtypes' => $this->getFilterDataRecursive('benefits_preferences', $s->benefits_id)['subtypes'],
                    ];
                }

                return [
                    'main' => [
                        'id' => $main->benefits_id,
                        'name' => $main->benefits_name,
                    ],
                    'subtypes' => $subtypes,
                    'has_subtypes' => count($subtypes) > 0,
                ];

            case 'nurse_type':
                // Fetch the main parent record
                $main = DB::table('practitioner_type')
                    ->where('id', $parentId)
                    ->first();

                $subs = DB::table('practitioner_type')
                                ->where('parent', $parentId)
                                ->get();


                $subtypes = [];
                foreach ($subs as $s) {
                    $subtypes[] = [
                        'id' => $s->id,
                        'name' => $s->name,
                        'subtypes' => $this->getFilterDataRecursive('work_environment', $s->id)['subtypes'] ?? [],
                    ];
                }

                // Final structured response
                return [
                    'main' => [
                        'id' => $main->id ?? null,
                        'name' => $main->name ?? null,
                    ],
                    'subtypes' => $subtypes,
                    'has_subtypes' => count($subtypes) > 0,
                ];

            case 'speciality':
                // Fetch the main parent record
                $main = DB::table('speciality')
                    ->where('id', $parentId)
                    ->first();

                $subs = DB::table('speciality')
                                ->where('parent', $parentId)
                                ->get();


                $subtypes = [];
                foreach ($subs as $s) {
                    $subtypes[] = [
                        'id' => $s->id,
                        'name' => $s->name,
                        'subtypes' => $this->getFilterDataRecursive('speciality', $s->id)['subtypes'] ?? [],
                    ];
                }

                // Final structured response
                return [
                    'main' => [
                        'id' => $main->id ?? null,
                        'name' => $main->name ?? null,
                    ],
                    'subtypes' => $subtypes,
                    'has_subtypes' => count($subtypes) > 0,
                ];


            default:
                return [
                    'main' => null,
                    'subtypes' => [],
                    'has_subtypes' => false,
                ];
        }
    }

    public function getSavedSearch(Request $request)
    {
        $searches_id = $request->id;
        $search = SavedSearches::find($searches_id);

        $filters = json_decode($search->filters, true); // decode JSON to array

        return response()->json([
            'search' => $search,
            'filters' => $filters,
        ]);
    }


    public function removeFilter(Request $request, $id)
    {
        $savedSearch = SavedSearches::findOrFail($id);
        $filters = json_decode($savedSearch->filters, true) ?? [];

        $value = $request->input('value');

        // Remove the value from the array
        $filters = array_values(array_filter($filters, function($v) use ($value) {
            return $v !== $value;
        }));

        // Update the record
        $savedSearch->filters = json_encode($filters, JSON_UNESCAPED_UNICODE);
        $savedSearch->save();

        return response()->json([
            'status' => 'success',
            'filters' => $filters
        ]);
    }


    public function updateAlert(Request $request)
    {
        $searches_id = $request->search_id;
        $search = SavedSearches::find($searches_id);
        $search->alert = $request->frequency_value;
        $run = $search->save();
    }


    public function run($id)
    {
        // Step 1: Get saved search by ID
        $savedSearch = SavedSearches::find($id);

        if (!$savedSearch) {
            return response()->json(['error' => 'Saved search not found.'], 404);
        }

        // Step 2: Decode filters (JSON string → PHP array)
        $filters = json_decode($savedSearch->filters, true);

        if (empty($filters) || !is_array($filters)) {
            return response()->json(['message' => 'No filters available for this search.'], 200);
        }

        // Step 3: Build the query dynamically
        $query = DB::table('job_boxes');

        // Sector (single value)
        if (!empty($filters['sector'])) {
            $query->where('sector', $filters['sector']);
        }

        // Employment type (multiple IDs)
        if (!empty($filters['employment_type'])) {
            $query->whereIn('emplyeement_type', $filters['employment_type']);
        }

        // Work shift (multiple IDs)
        if (!empty($filters['work_shift'])) {
            $query->whereIn('shift_type', $filters['work_shift']);
        }

        // Work environment
        if (!empty($filters['work_environment'])) {
            $query->whereIn('work_environment', $filters['work_environment']);
        }

        // Employee positions
        if (!empty($filters['employee_positions'])) {
            $query->whereIn('emplyeement_positions', $filters['employee_positions']);
        }

        // Nurse type
        // if (!empty($filters['nurse_type'])) {
        //     $query->whereIn('nurse_type_id', $filters['nurse_type']);
        // }

        // // Speciality
        // if (!empty($filters['speciality'])) {
        //     $query->whereIn('speciality_id', $filters['speciality']);
        // }

        // Salary range
        if (!empty($filters['salary_range'])) {
            $min = $filters['salary_range']['min'] ?? null;
            $max = $filters['salary_range']['max'] ?? null;

            if ($min && $max) {
                $query->whereBetween('salary', [$min, $max]);
            }
        }

        // Years of experience
        if (!empty($filters['years_of_experience'])) {
            $query->where('experience_level', '>=', $filters['years_of_experience']);
        }

        // Step 4: Get results
        $results = $query->get();

        // Step 5: Update "last_run_at" for tracking
        $savedSearch->update(['last_run_at' => now()]);

        // Step 6: Return response
        return response()->json([
            'message' => 'Search executed successfully.',
            'filters' => $filters,
            'results' => $results
        ]);
    }

    public function get_tags()
    {
        $employeement_type = DB::table("employeement_type_preferences")->where("sub_prefer_id","!=","0")->get();
        $shift_type = DB::table("work_shift_preferences")->where("shift_id","!=","0")->get();
        $work_environment = DB::table("work_enviornment_preferences")->where("sub_env_id","!=","0")->get();
        $employee_positions = DB::table("employee_positions")->where("subposition_id","!=","0")->get();
        $benefits = DB::table("benefits_preferences")->where("subbenefit_id","!=","0")->get();
        $practitioner_type = DB::table("practitioner_type")->where("parent","!=","0")->get();
        $speciality = DB::table("speciality")->where("parent","!=","0")->get();

        $allTags = [];
        //print_r($employeement_type);die;
        foreach($employeement_type as $emp_type){
            $allTags[] = $emp_type->emp_type;
        }

        foreach($shift_type as $stype){
            $allTags[] = $stype->shift_name;
        }

        foreach($work_environment as $wenvironment){
            $allTags[] = $wenvironment->env_name;
        }

        foreach($employee_positions as $employee_pos){
            $allTags[] = $employee_pos->position_name;
        }

        foreach($benefits as $bene){
            $allTags[] = $bene->benefits_name;
        }

        foreach($practitioner_type as $practype){
            $allTags[] = $practype->name;
        }

        foreach($speciality as $spec){
            $allTags[] = $spec->name;
        }

        $allTags = array_merge($allTags, ['Public & Government', 'Private', 'Public Government & Private']);

        return json_encode($allTags);
    }

    public function get_filters_data()
    {
        $user_id = Auth::guard('nurse_middle')->user()->id;
        $work_prefer_data = DB::table("work_preferences")->where("user_id",$user_id)->first();

        $sector_data = $work_prefer_data->sector_preferences;
        $emptype_preferences = json_decode($work_prefer_data->emptype_preferences);
        $worktype_preferences = json_decode($work_prefer_data->work_environment_preferences);

        $saved_filters = [];
        if(!empty($emptype_preferences)){
            foreach($emptype_preferences as $emptype_prefer){
                foreach($emptype_prefer as $emptype_prefer1){
                    $employeement_type = DB::table("employeement_type_preferences")->where("emp_prefer_id",$emptype_prefer1)->first();
                    $saved_filters[] = $employeement_type->emp_type;
                }
            }
        }

        if(!empty($worktype_preferences)){
            foreach($worktype_preferences as $workpreferences){
                foreach($workpreferences as $index=>$workpreferences1){
                    $workprefertype = DB::table("work_enviornment_preferences")->where("prefer_id",$index)->first();
                    $saved_filters[] = $workprefertype->env_name;
                    foreach($workpreferences1 as $workpreferences2){
                        $workprefertype1 = DB::table("work_enviornment_preferences")->where("prefer_id",$workpreferences2)->first();
                        $saved_filters[] = $workprefertype1->env_name;
                    }
                }
            }
        }

        $saved_filters = array_merge($saved_filters, [$sector_data]);

        //print_r($saved_filters);

        return json_encode($saved_filters);
    }

    public function getEmptypeData(Request $request)
    {
        print_r($request->all());die;
        $emp_ids = json_decode($request->id_arr);

        $emp_name_arr = [];
        foreach($emp_ids as $emp_id){
            $emp_prefer_data = DB::table("employeement_type_preferences")->where("emp_prefer_id",$emp_id)->first();
            $emp_name_arr[] = $emp_prefer_data->emp_type;
        }

        return json_encode($emp_name_arr);

    }





}