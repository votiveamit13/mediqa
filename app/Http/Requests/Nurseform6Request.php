<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Nurseform6Request extends FormRequest
{
    public function rules()
    {      
        
        // Decode JSON strings to arrays
        $this->merge([
            'vaccination_record' => json_decode($this->input('vaccination_record'), true),
        ]);
        return[
            'vaccination_record' => 'required',
            'immunization_status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vaccination_record.required'  => 'This field is required.',
            'immunization_status.required' => 'This field is required.',           
        ];
    }
}
