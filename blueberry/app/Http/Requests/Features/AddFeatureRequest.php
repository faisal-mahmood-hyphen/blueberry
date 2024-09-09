<?php

namespace App\Http\Requests\Features;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddFeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('features')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'status'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.', // 'Feature' is the name of your roles table
            'name.unique' => 'The feature name must be unique and this role name already in use.', // 'Feature' is the name of your roles table
            'status.required' => 'The status field is required.', // 'Feature' is the status of your roles table
        ];
    }
}
