<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SEQRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [

            // Ensure seq_type selection
            'seq_type' => 'required|in:individual,multiple,area',

            // Validation for individual tree data
            'individual' => 'required_if:seq_type,individual|array',
            'individual.*.species' => 'required_if:seq_type,individual|string|max:255',
            'individual.*.gbh' => 'required_if:seq_type,individual|numeric|min:0',
            'individual.*.height' => 'required_if:seq_type,individual|numeric|min:0',
            'individual.*.density' => 'required_if:seq_type,individual|numeric|min:0',

            // Validation for multiple tree data
            'multiple' => 'required_if:seq_type,multiple|array',
            'multiple.*.species' => 'required_if:seq_type,multiple|string|max:255',
            'multiple.*.gbh' => 'required_if:seq_type,multiple|numeric|min:0',
            'multiple.*.height' => 'required_if:seq_type,multiple|numeric|min:0',
            'multiple.*.density' => 'required_if:seq_type,multiple|numeric|min:0',

            // Validation for area tree data
            'sample_area' => 'required_if:seq_type,area|numeric|min:0.01',
            'total_area' => 'required_if:seq_type,area|numeric|min:0.01',
            'area' => 'required_if:seq_type,area|array',
            'area.*.species' => 'required_if:seq_type,area|string|max:255',
            'area.*.gbh' => 'required_if:seq_type,area|numeric|min:0',
            'area.*.height' => 'required_if:seq_type,area|numeric|min:0',
            'area.*.density' => 'required_if:seq_type,area|numeric|min:0',

        ];
    }

    public function messages()
    {
        return [

            // General
            'seq_type.required' => 'Please select at least one option.',
            'seq_type.in' => 'Invalid selection. Choose from Individual, Multiple, or Area.',

            // Individual data
            'individual.required_if' => 'Please add at least one row in this section.',
            'individual.*.species.required_if' => 'Species is required.',
            'individual.*.gbh.required_if' => 'GBH is required.',
            'individual.*.gbh.min' => 'Please Enter Positive Value',
            'individual.*.height.required_if' => 'Height is required.',
            'individual.*.height.min' => 'Please Enter Positive Value',
            'individual.*.density.required_if' => 'Density is required.',
            'individual.*.density.min' => 'Please Enter Positive Value',

            // Multiple data
            'multiple.required_if' => 'Please add at least one row in this section.',
            'multiple.*.species.required_if' => 'Species is required.',
            'multiple.*.gbh.required_if' => 'GBH is required.',
            'multiple.*.gbh.min' => 'Please Enter Positive Value',
            'multiple.*.height.required_if' => 'Height is required.',
            'multiple.*.height.min' => 'Please Enter Positive Value',
            'multiple.*.density.required_if' => 'Density is required.',
            'multiple.*.density.min' => 'Please Enter Positive Value',

            // Area data
            'sample_area.required_if' => 'Sample area is required.',
            'total_area.required_if' => 'Total area is required.',
            'area.required_if' => 'Please add at least one row in this section.',
            'area.*.species.required_if' => 'Species is required.',
            'area.*.gbh.required_if' => 'GBH is required.',
            'area.*.gbh.min' => 'Please Enter Positive Value',
            'area.*.height.required_if' => 'Height is required.',
            'area.*.height.min' => 'Please Enter Positive Value',
            'area.*.density.required_if' => 'Density is required.',
            'area.*.density.min' => 'Please Enter Positive Value',

        ];
    }
}
