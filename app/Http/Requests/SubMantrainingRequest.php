<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubMantrainingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'subtrainingeducation' => 'required',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'subtrainingeducation.required' => 'This field is required.',
            'type.required' => 'This field is required.',
        ];
    }
}
