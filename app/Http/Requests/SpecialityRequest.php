<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'speciality' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'speciality.required' => 'The profession field is required.',
        ];
    }
}
