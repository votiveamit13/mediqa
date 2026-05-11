<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editSeoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'status' => 'required',
            // 'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'meta_title.required' => 'The meta title  field is required.',
            'meta_desc.required' => 'The meta description field is required.',
            'status.required' => 'The status field is required.',
            // 'image.required' => 'The image field is required.',
        ];
    }
}
