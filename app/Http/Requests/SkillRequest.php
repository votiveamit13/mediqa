<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    public function rules()
    {
        return [
            'skill' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'skill.required' => 'The skill name field is required.',
        ];
    }
}
