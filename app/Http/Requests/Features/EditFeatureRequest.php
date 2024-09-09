<?php

namespace App\Http\Requests\Features;

use App\Models\Feature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditFeatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $feature = Feature::where('id',$this->id)->first();
        if(!$feature){
            return false;
        }
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
                Rule::unique('features')->ignore($this->id)->where(function ($query) {
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
            'name.unique' => 'The role name must be unique and this role name already in use.', // 'Feature' is the name of your roles table
            'status.required' => 'The status field is required.', // 'Feature' is the status of your roles table
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
