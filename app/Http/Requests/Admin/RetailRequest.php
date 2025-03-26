<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RetailRequest extends FormRequest
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
            'cust_name' => 'required',
            'pan' => 'required|regex:/^[A-Z]{5}\d{4}[A-Z]$/',
            'address' => 'required',
            'pincode' => 'required',
            // 'state' => 'required',
            'city' => 'required',
            'email' => array('required', 'regex:/(.+)@(.+)\.(.+)/i'),
            'fy.*.asset_class' => 'required',
            'sector' => 'required',
            'zone' => 'required',
            'reg_address' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            'mobile'  =>'required|digits:10',
        ];
    }

    public function messages()
    {
        return [
            'cust_name.required' => 'Customer Name must be required',
            'comp_type.required'=>'Type must be required',
            'fy.*.asset_class.required'=>'Class must be required',
            'cin.regex'=>'Invalid CIN',
            'pan.required'=>'Pan must be required',
            'pan.regex'=>'Invalid PAN',
            'zone.required'=>'Zone must be required',
            'email.required' => 'Email must be required',
            // 'email.unique' => 'Email must be Unique',
            'mobile.required' => 'Mobile must be required',
            'mobile.digits'  =>'Mobile number must be 10 Digits',
            // 'cin.regex'=>'Invalid CIN',
        ];
    }
}
