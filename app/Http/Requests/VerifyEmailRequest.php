<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    public function rules()
    {
        return [
           'email' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
        ];
    }
}
