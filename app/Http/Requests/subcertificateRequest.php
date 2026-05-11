<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subcertificateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'general_sub_certificate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'general_sub_certificate.required' => 'The general sub certificate field is required.',
        ];
    }
}