<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAdminProfile extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required', 'min:3',
            'email' => 'required', 'email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
        ];
    }
}
