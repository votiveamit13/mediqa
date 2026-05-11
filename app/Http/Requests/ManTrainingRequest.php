<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManTrainingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'man_training' => 'required',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'man_training.required' => 'This field is required.',
            'type.required' => 'This field is required.',
        ];
    }
}
