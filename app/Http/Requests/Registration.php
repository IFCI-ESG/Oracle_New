<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registration extends FormRequest
{
    public static $rules = [
        'name' => 'required|string|max:255',
        'pan' => array('required', 'regex:/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/', 'unique:users'),
        'cin_llpin' => array('sometimes','nullable','required_if:type,Limited Liability Partnership,Company','regex:/^([L|U]{1})([0-9]{5})([A-Za-z]{2})([0-9]{4})([A-Za-z]{3})([0-9]{6})$/'),
        'inc_date' => 'required|date',
        'ts_id' => 'required',
        'reg_off_add' => 'required|string|max:255',
        'reg_off_pin' => 'required|numeric|digits:6',
        'reg_off_state' => 'required|string|max:255',
        'reg_off_city' => 'required|string|max:255',
        'co_off_add' => 'required|string|max:255',
        'co_off_pin' => 'required|numeric|digits:6',
        'co_off_state' => 'required|string|max:255',
        'co_off_city' => 'required|string|max:255',
        'contact_person' => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'contact_add' => 'required|string|max:255',
        'email' => array('required', 'regex:/(.+)@(.+)\.(.+)/i', 'unique:users'),
        'mobile' => 'required|numeric|digits:10|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'checkbox' => 'accepted',
    ];

    public function authorize()
    {
        return true;
    }



    public function rules(): array
    {
        return self::$rules;
    }
}
