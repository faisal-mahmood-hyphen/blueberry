<?php

namespace App\Http\Requests\BodyTypes;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddBodyTypeRequest extends FormRequest
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
                'string',
                'max:255',
                'unique:body_types'
            ],
            'status'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.', // 'roles' is the name of your roles table
            'name.unique' => 'The Car Brands name must be unique and this car brand name already in use.', // 'roles' is the name of your roles table
            'status.required' => 'The status field is required.',
        ];
    }
}
