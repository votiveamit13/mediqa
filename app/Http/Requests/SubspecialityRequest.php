<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubspecialityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'subspeciality' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'subspeciality.required' => 'The sub profession  field is required.',
        ];
    }
}
