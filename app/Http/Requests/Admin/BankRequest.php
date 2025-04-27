<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bank_name' => 'required',
            'pan' => 'required|regex:/^[A-Z]{5}\d{4}[A-Z]$/',
            'email' => array('required', 'regex:/(.+)@(.+)\.(.+)/i'),
            'contact_person' => 'required',
            'designation' => 'required',
            'mobile'  =>'required|digits:10',
        ];
    }

    public function messages()
    {
        return [
            'bank_name.required' => 'This Field is required',
            'pan.required'=>'Pan must be required',
            'pan.regex'=>'Invalid PAN',
            'email.required' => 'Email must be required',
            'email.regex' => 'Invalid Format',
            'contact_person.required' => 'This Field is required',
            'designation.required' => 'This Field is required',
            'mobile.required' => 'Mobile must be required',
            'mobile.digits'  =>'Mobile number must be 10 Digits',
        ];
    }
}
