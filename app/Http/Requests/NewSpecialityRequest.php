<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewSpecialityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'newSpeciality' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'newSpeciality.required' => 'The speciality field is required.',
        ];
    }
}
