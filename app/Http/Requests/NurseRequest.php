<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NurseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required',
            'contact' => 'required',
            'dob' => 'required',
            'per_website' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'home_address' => 'required',
            'emrg_contact' => 'required',
            'emrg_email' => 'required',
            'profile_image' => 'required',
            
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'   => 'The first name field is required.',
            'last_name.required'    => 'The last name field is required.',
            'email.required'        => 'The email field is required.',
            'gender.required'       => 'The gender field is required.',
            'contact.required'      => 'The mobile number field is required.',
            'dob.required'          => 'The date of birth field is required.',
            'per_website.required'  => 'The personal website field is required.',
            'country.required'      => 'The country field is required.',
            'state.required'        => 'The state field is required.',
            'city.required'         => 'The city field is required.',
            'zip_code.required'     => 'The Zip code field is required.',
            'home_address.required'  => 'The home address field is required.',
            'emrg_contact.required'  => 'The mobile number field is required.',
            'emrg_email.required'    => 'The email field is required.',
            'profile_image.required' => 'The profile image field is required.',

        ];
    }
}
