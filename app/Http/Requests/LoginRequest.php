<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    private $dataObject;

    public function __construct() {
        // Initialize $dataObject as a new stdClass object
        $this->dataObject = new \stdClass();
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|check_password',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
            'email.exists' => 'Invalid email address',
            'password.check_password' => 'Invalid password',
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'data' =>$this->dataObject,
            'status' => 0,
            'errors' => $validator->errors(),
        ], 400));
    }
}
