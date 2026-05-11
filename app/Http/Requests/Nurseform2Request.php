<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Nurseform2Request extends FormRequest
{
    public function rules()
    {
        return [
            'states' => 'required',
            'specialties' => 'required',
            'bio' => 'required',
            'declare_information' => 'required'           
        ];
    }

    public function messages()
    {
        return [
            'states.required'         => 'Please select one or more Type of nurse.',
            'states.required'         => 'Please select one or more Type of nurse.',
            'bio.required'            => 'The professional bio field is required.',
            'declare_information.required'  => 'The declare information  field is required.',
        ];
    }
}
