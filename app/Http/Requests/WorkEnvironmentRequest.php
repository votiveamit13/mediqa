<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkEnvironmentRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->input('form_type')) {
            case 'environment_form':
                return [
                    'env_name' => 'required'
                ];

            case 'position_form':
                return [
                    'position_name' => 'required'
                ];
               
            case 'work_shift_form':
                return [
                    'work_shift_name' => 'required'
                ];
                
            case 'benefit_form':
                return [
                    'benefit_name' => 'required'
                ];    
               
            case 'employeement_type_form':
                return [
                    'emp_type_name' => 'required'
                ];          

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'env_name.required' => 'The environment name field is required.',
            'position_name.required' => 'The position name field is required.',
            'work_shift_name.required' => 'The work shift name field is required.',
            'benefit_name.required' => 'The benefit name field is required.',
            'emp_type_name.required' => 'The employeement type field is required.'
        ];
    }
}
