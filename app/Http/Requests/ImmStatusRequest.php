<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImmStatusRequest extends FormRequest
{
    public function rules()
    {
        return [
            'immu_status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'evidence.required' => 'This field is required.',
        ];
    }
}
