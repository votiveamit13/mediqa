<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Nurseform5Request extends FormRequest
{
    public function rules()
    {         
        return[
            'tra_start_date' => 'required',
            'tra_end_date' => 'required',
            'institution1' => 'required',
            'mand_continue_education' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'tra_start_date.required'               => 'This field is required.',
            'tra_end_date.required'                 => 'This field is required.',
            'institution1.required'                  => 'This field is required.',
            'mand_continue_education.required'      => 'This field is required.',            
        ];
    }
}
