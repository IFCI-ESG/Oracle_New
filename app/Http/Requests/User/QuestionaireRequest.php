<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionaireRequest extends FormRequest
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
            'ques.*.value' => 'required|numeric|min:0|max:9999999999999',
            // 'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',

        ];
    }

    public function messages()
    {
        return [
            'ques.*.value.required' => 'This Field must be required',
            'ques.*.value.min' => 'Please Enter Positive Value',
            // 'email.required' => 'Email must be required',
        ];
    }
}
