<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AwardsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'award_name' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'award_name.required' => 'The award name field is required.',
            
        ];
    }
}
