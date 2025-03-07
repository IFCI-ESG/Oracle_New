<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email_id' => 'required', 'regex:/(.+)@(.+)\.(.+)/i',
            'mobile'  =>'required|digits:10',
            'password'=>'required|string|min:8|confirmed',
            'user_type'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'This field must be required',
            'email_id.required' => 'Email must be required and should be unique',
            'mobile.required'  =>'Mobile number must be 10 Digits',
            'password.required'=>'Password must be required',
            'user_type.required'=>'Please select admin type',
        ];
    }

}
