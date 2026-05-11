<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRegisteredCountry extends FormRequest
{
    public function rules()
    {
        return [
            // Conditional: required only if status == 3 
            'registration.*.mobile_number' => ['required_if:registration.*.status,3'],
            'registration.*.jurisdiction' => ['required_if:registration.*.status,3'],
            'registration.*.registration_number' => ['required_if:registration.*.status,3'],
            'registration.*.expiry_date' => ['after:today'],
            'registration.*.upload_evidence' => ['required_if:registration.*.status,3', 'min:1'],

        ];
    }

    public function messages()
    {
        return [
            // 'registration_countries.required' => 'Please select at least one registration country.',
            'registration.*.mobile_number.required_if' => 'Mobile number is required when submit for review.',
            'registration.*.jurisdiction.required_if' => 'Jurisdiction is required when submit for review.',
            'registration.*.registration_number.required_if' => 'Registration number is required when submit for review.',
            'registration.*.expiry_date.after' => 'Expiry date must be a future date.',
            'registration.*.upload_evidence.required_if' => 'Evidence upload is required when submit for review.',

           
            // 'email.required' => 'The email field is required.',
        ];
    }
}
