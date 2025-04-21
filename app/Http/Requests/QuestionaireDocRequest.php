<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionaireDocRequest extends FormRequest
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
            'doc' => 'required|mimes:pdf|max:20000',

        ];
    }

    public function messages()
    {
        return [
            'doc.required' => 'This Field must be required',
            'doc.mimes' => 'Only PDF files are allowed',
            'doc.max' => 'Max size allowed is 20 MB',
        ];
    }
}
