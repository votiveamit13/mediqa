<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionalcerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'certificate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'certificate.required' => 'The certificate name field is required.',
        ];
    }
}
