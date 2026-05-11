<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipTypeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'membership_type' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'membership_type.required' => 'The membership type field is required.',
            
        ];
    }
}
