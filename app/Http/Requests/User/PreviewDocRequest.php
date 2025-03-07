<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PreviewDocRequest extends FormRequest
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
            'undertaking' => 'required|mimes:pdf|max:20000',
        ];
    }

    public function messages()
    {
        return [
            'undertaking.required' => 'This Field must be required',
            'undertaking.mimes' => 'Only PDF files are allowed',
            'undertaking.max' => 'Max size allowed is 20 MB',
        ];
    }
}
