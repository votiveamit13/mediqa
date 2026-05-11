<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Nurseform3Request extends FormRequest
{
    public function rules()
    {
         // Decode JSON strings to arrays
        $this->merge([
            'training_courses' => json_decode($this->input('training_courses'), true),
            // 'training_workshop' => json_decode($this->input('training_workshop'), true),
            'professional_certification' => json_decode($this->input('professional_certification'), true),
        ]);

        return [
            'ndegree' => 'required',
            'institution' => 'required',
            'most_relevant' => 'required',
            'graduation_start_date' => 'required',
            'graduation_end_date' => 'required', 
            'professional_certification' => 'required',
            // 'training_courses' => 'required',
            // 'training_workshop' => 'required',      
            'training_courses' => 'required|min:1',
            // 'training_workshop' => 'required|min:1',
  
        ];
    }

    public function messages()
    {
        return [
            'ndegree.required'                     => 'This field is required.',
            'institution.required'                 => 'This field is required.',
            'most_relevant.required'               => 'This field is required.',
            'graduation_start_date.required'       => 'This field is required.',
            'graduation_end_date.required'         => 'This field is required.',
            'professional_certification.required'  => 'This field is required.',
            'training_courses.required'            => 'This field is required.',
            // 'training_workshop.required'           => 'This field is required.',
        ];
    }
}
