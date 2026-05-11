<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvidenceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'evidence' => 'required',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'evidence.required' => 'The evidence name field is required.',
            'type.required'     => 'The evidence type field is required.',
        ];
    }
}
