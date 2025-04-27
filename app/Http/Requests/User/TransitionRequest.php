<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class TransitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'policy.*.value' => 'required',
            'tech.*.value' => 'required',
            'market.*.value' => 'required',
            'reputation.*.value' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'policy.*.value.required' => 'This Field must be required',
            'tech.*.value.required' => 'This Field must be required',
            'market.*.value.required' => 'This Field must be required',
            'reputation.*.value.required' => 'This Field must be required',
        ];
    }
}
