<?php

namespace App\Http\Requests\BodyTypes;

use App\Models\BodyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditBodyTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $bodyTypes = BodyType::where('id',$this->id)->first();
        if(!$bodyTypes){
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
                'string',
                'max:255',
                Rule::unique('body_types')->ignore($this->id)->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'status'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.', // 'roles' is the name of your roles table
            'name.unique' => 'The car brand name must be unique and this car brand name already in use.', // 'roles' is the name of your roles table
            'status.required' => 'The status field is required.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
