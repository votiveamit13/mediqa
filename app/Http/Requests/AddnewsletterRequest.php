<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddnewsletterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'emailNewsletter' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'emailNewsletter.required' => 'The email field is required.',
            'emailNewsletter.email' => 'The email you provided is invalid.',
        ];
    }
}
