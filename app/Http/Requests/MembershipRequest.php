<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
{
    public function rules()
    {
        return [
            'country' => 'required',
            'organization_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'country.required' => 'The country name field is required.',
            'organization_name.required' => 'The organization name field is required.',
        ];
    }
}
