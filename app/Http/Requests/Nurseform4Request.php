<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Nurseform4Request extends FormRequest
{
    public function rules()
    {
         
        // Decode JSON strings to arrays
        $this->merge([
            'skills_compantancies' => json_decode($this->input('skills_compantancies'), true),
            'positions_held' => json_decode($this->input('positions_held'), true),
        ]);

        return [
            'previous_employer_name' => 'required',
            'positions_held' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'job_responeblities' => 'required', 
            'achievements' => 'required',
            'present_box' => 'required',
            // 'training_workshop' => 'required',      
            'skills_compantancies' => 'required|min:1',
            // 'training_workshop' => 'required|min:1',
  
        ];
    }

    public function messages()
    {
        return [
            'previous_employer_name.required'       => 'This field is required.',
            'institution.required'                  => 'This field is required.',
            'positions_held.required'               => 'This field is required.',
            'start_date.required'                   => 'This field is required.',
            'end_date.required'                     => 'This field is required.',
            'job_responeblities.required'           => 'This field is required.',
            'achievements.required'                 => 'This field is required.',
            'skills_compantancies.required'         => 'This field is required.',
            'present_box.required'                  => 'This field is required.',
        ];
    }
}
