<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class GovernanceRequest extends FormRequest
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

            'board.*.value' => 'required',
            'board.*.details' => 'required_if:board.*.value,Y',

            'comp.*.complaints' => 'required',
            'comp.*.no_of_complaints' => 'numeric|min:0|max:9999999999999',
            'comp.*.no_of_pending_complaints' => 'numeric|min:0|max:9999999999999',

            'rnd.*.percentage' => 'numeric|min:0|max:100',

            'policy.*.policy_val' => 'required',

            'fine.*.fine_amt' => 'numeric|min:0|max:9999999999999'

        ];
    }

    public function messages()
    {
        return [

            'board.*.value.required' => 'This Field must be required',
            'board.*.details.required' => 'This Field must be required',

            'comp.*.complaints.required' => 'This Field must be required',
            'comp.*.no_of_complaints.required' => 'This Field must be required',
            'comp.*.no_of_complaints.min' => 'Please Enter Positive Value',
            'comp.*.no_of_complaints.max' => 'Max Limit 9999999999999',

            'rnd.*.percentage.min' => 'Please Enter Positive Value',
            'rnd.*.percentage.max' => 'Max Limit 9999999999999',

            'policy.*.policy_val.required' => 'This Field must be required',

            'fine.*.fine_amt.min' => 'Please Enter Positive Value',
            'fine.*.fine_amt.max' => 'Max Limit 9999999999999',

        ];
    }
}
