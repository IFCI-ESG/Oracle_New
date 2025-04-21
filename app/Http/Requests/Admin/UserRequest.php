<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'comp_name' => 'required',
            'auth_name' => 'required',
            'comp_type' => 'required',
            'asset_class' => 'required',
            'sector' => 'required',
            'zone' => 'required',
            'auth_name' => 'required',
            'designation' => 'required',
            'reg_address' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            // 'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'email' => array('required', 'regex:/(.+)@(.+)\.(.+)/i'),
            'mobile'  =>'required|digits:10',
            'password'=>'required|string|min:5',
            'categories.*' => 'in:E,S,G',
            'pan' => 'required|regex:/^[A-Z]{5}\d{4}[A-Z]$/',
            // 'cin_llpin' => array('sometimes','nullable','required_if:type,Limited Liability Partnership,Company','regex:/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/'),
            'cin' => 'regex:/^[A-Z]\d{5}[A-Z]{2}\d{4}[A-Z]+\d{6}$/',
        ];
    }

    public function messages()
    {
        return [
            'comp_name.required' => 'Company Name must be required',
            'auth_name.required' => 'Person Name must be required',
            'comp_type.required'=>'Type must be required',
            'asset_class.required'=>'Class must be required',
            'cin.regex'=>'Invalid CIN',
            'pan.required'=>'Pan must be required',
            'pan.regex'=>'Invalid PAN',
            'sector.required'=>'Sector must be required',
            'zone.required'=>'Zone must be required',
            // 'auth_name.required' => 'Company Name must be required',
            // 'designation.required'=>'Designation must be required',
            'email.required' => 'Email must be required',
            // 'email.unique' => 'Email must be Unique',
            'mobile.required' => 'Mobile must be required',
            'mobile.digits'  =>'Mobile number must be 10 Digits',
            'password.required'=>'Password must be required',
            // 'cin.regex'=>'Invalid CIN',
        ];
    }
}
