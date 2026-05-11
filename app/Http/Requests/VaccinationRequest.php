<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaccinationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'vaccination' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vaccination.required' => 'The vaccination name field is required.',
        ];
    }
}
