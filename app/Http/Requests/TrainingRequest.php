<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'training' => 'required',
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'training.required' => 'The training name field is required.',
            'type.required'     => 'The type name field is required.',
        ];
    }
}
