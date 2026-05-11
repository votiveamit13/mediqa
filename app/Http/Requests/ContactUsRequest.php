<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
{
    public function rules()
    {
        return [
           'name' => 'required',
           'lastname' => 'required',
           'email' => 'required',
           'message' => 'required',
           'phone_no' => 'required',
        //    'checkout' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The First name field is required.',
            'lastname.required' => 'The Last name field is required.',
            'email.required' => 'The email field is required.',
            'message.required' => 'The message field is required.',
            'phone_no.required' => 'The phone no field is required.',
            'checkout.required' => 'Please agree to the terms and policy.'
        ];
    }
}
