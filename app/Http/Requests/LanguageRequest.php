<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->input('form_type')) {
            case 'basic_form':
                return [
                    'language_name' => 'required',
                    'language_field_type' => 'required',
                ];

            case 'certification_form':
                return [
                    'language_name' => 'required',
                    'test_id' => 'required',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'language_name.required' => 'The language name field is required.',
            'language_field_type.required' => 'The language type field is required.',
            'test_id.required' => 'The proficiency level is required.',
        ];
    }
}
