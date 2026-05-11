<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfile extends FormRequest
{
    public function rules()
    {
       $id= Auth::guard('admin')->user()->id;
        return [
        'name' => 'required|min:3',
        'functions' => 'required|min:3',
        // 'phone' => 'required|digits:10',
        'phone' => 'required',
         'email' => 'required|email|unique:admin,email,' . $id, 
         'user_name' => 'required|unique:admin,user_name,' . $id, 
       
    ];
    }

    public function messages()
    {
        return [
        'name.required' => 'The name field is required.',
        'name.min' => 'The name must be at least :min characters.',
        'functions.required' => 'The function field is required.',
        'functions.min' => 'The function must be at least :min characters.',
        'email.required' => 'The Email address field is required.',
        'email.unique' => 'Email is Already Exist.',
        'user_name.required' => 'The username field is required.',
        'user_name.unique' => 'User name is Already Exist.',
    ];
    }
}
