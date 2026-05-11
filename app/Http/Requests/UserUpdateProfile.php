<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfile extends FormRequest
{
    public function rules()
    {
        return [
            'fullname' => 'required',
            'min:3',
            'lastname' => 'required',
            'countryCode' => 'required',

            'contact' => 'required',

            'post_code' => 'required',
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:today', // not in the future 
                'before_or_equal:' . now()->subYears(10)->toDateString(), // at least 10 years old 
              ],
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',

            'gender' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'The First name field is required.',
            'lastname.required' => 'The Last name field is required.',
            'countryCode.required' => 'The Country Code field is required.',

            'contact.required' => 'The Mobile Number  field is required.',

            'post_code.required' => 'The Post_code field is required.',
            'date_of_birth.required' => 'The Date of Birth field is required.',
            'date_of_birth.before_or_equal' => 'Date of Birth cannot be in the future and must be at least 10 years old.',
            'country.required' => 'Please Select Country.',
            'state.required' => 'Please Select State.',
            'city.required' => 'The City field is required.',
            'gender.required' => 'The Gender is required',

            // 'email.required' => 'The email field is required.',
        ];
    }
}
