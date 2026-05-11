<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
{
    private $dataObject;
    public function __construct() {
        // Initialize $dataObject as a new stdClass object
        $this->dataObject = new \stdClass();
    }
    public function rules()
    {
        return [
            'old_password' => 'required|min:6',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

   
}
