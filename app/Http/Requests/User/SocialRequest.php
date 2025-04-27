<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
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

            'emp.*.male' => 'numeric|min:0|max:9999999999999',
            'emp.*.female' => 'numeric|min:0|max:9999999999999',
            'emp.*.others' => 'numeric|min:0|max:9999999999999',

            'women.*.women_tot_emp' => 'numeric|min:0|max:9999999999999',
            'women.*.women_tot_female_emp' => 'numeric|min:0|max:9999999999999',

            'cost_incurr.*.cost_incurred' => 'numeric|min:0|max:9999999999999',
            'cost_incurr.*.tot_revenue' => 'numeric|min:0|max:9999999999999',

            'train.*.train_tot_emp' => 'numeric|min:0|max:9999999999999',
            'train.*.train_amt_spent' => 'numeric|min:0|max:9999999999999',

            'csr.*.csr_details' => 'required',
            'csr.3.csr_details' => 'required|numeric|min:0|max:9999999999999',

            'csr_acti.*.csr_activity' => 'required',
            // 'csr_acti.*.sdg_id' => 'required_if:csr_acti.*.csr_activity,Y',

            'csr_impact.csr_impact' => 'required',
            'csr_impact.*.csr_male' => 'required_if:csr_impact.csr_impact,Y|numeric|min:0|max:9999999999999',
            'csr_impact.*.csr_female' => 'required_if:csr_impact.csr_impact,Y|numeric|min:0|max:9999999999999',

            'welfare.*.Welfare_doc' => 'mimes:pdf|max:20000',

        ];
    }

    public function messages()
    {
        return [

            'emp.*.male.min' => 'Please Enter Positive Value',
            'emp.*.male.max' => 'Max Limit 9999999999999',
            'emp.*.female.min' => 'Please Enter Positive Value',
            'emp.*.female.max' => 'Max Limit 9999999999999',
            'emp.*.others.min' => 'Please Enter Positive Value',
            'emp.*.others.max' => 'Max Limit 9999999999999',

            'women.*.women_tot_emp.min' => 'Please Enter Positive Value',
            'women.*.women_tot_emp.max' => 'Max Limit 9999999999999',
            'women.*.women_tot_female_emp.min' => 'Please Enter Positive Value',
            'women.*.women_tot_female_emp.max' => 'Max Limit 9999999999999',

            'cost_incurr.*.cost_incurred.min' => 'Please Enter Positive Value',
            'cost_incurr.*.cost_incurred.max' => 'Max Limit 9999999999999',
            'cost_incurr.*.tot_revenue.min' => 'Please Enter Positive Value',
            'cost_incurr.*.tot_revenue.max' => 'Max Limit 9999999999999',

            'train.*.train_tot_emp.min' => 'Please Enter Positive Value',
            'train.*.train_tot_emp.max' => 'Max Limit 9999999999999',
            'train.*.train_amt_spent.min' => 'Please Enter Positive Value',
            'train.*.train_amt_spent.max' => 'Max Limit 9999999999999',

            'csr.*.csr_details.required' => 'This Field must be required',
            'csr.3.csr_details.required' => 'This Field must be required',
            'csr.3.csr_details.min' => 'Please Enter Positive Value',
            'csr.3.csr_details.max' => 'Max Limit 9999999999999',

            'csr_acti.*.csr_activity.required' => 'This Field must be required',
            // 'csr_acti.*.sdg_id.required_if' => 'This Field must be required',
            // 'csr_acti.*.sdg_id.min' => 'Please Enter Positive Value',
            // 'csr_acti.*.sdg_id.max' => 'Max Limit 9999999999999',

            'csr_impact.csr_impact.required' => 'This Field must be required',
            'csr_impact.*.csr_male.required_if' => 'This Field must be required',
            'csr_impact.*.csr_male.min' => 'Please Enter Positive Value',
            'csr_impact.*.csr_male.max' => 'Max Limit 9999999999999',
            'csr_impact.*.csr_female.required_if' => 'This Field must be required',
            'csr_impact.*.csr_female.min' => 'Please Enter Positive Value',
            'csr_impact.*.csr_female.max' => 'Max Limit 9999999999999',

            'welfare.*.Welfare_doc.mimes' => 'Only PDF files are allowed',
            'welfare.*.Welfare_doc.max' => 'Max size allowed is 20 MB',

        ];
    }
}
