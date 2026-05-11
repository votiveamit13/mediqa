<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DegreeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'degree' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'degree.required' => 'The degree name field is required.',
        ];
    }
}
