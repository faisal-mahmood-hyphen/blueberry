<?php

namespace App\Http\Requests\Brands;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $carBrands = Brand::where('id',$this->id)->first();
        if(!$carBrands){
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
                Rule::unique('brands')->ignore($this->id)->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'status'=>['required'],
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.', // 'roles' is the name of your roles table
            'name.unique' => 'The car brand name must be unique and this car brand name already in use.', // 'roles' is the name of your roles table
            'status.required' => 'The status field is required.',
            'image.image' => 'The image must be a valid image format (jpeg, png, jpg, gif).',
            'image.mimes' => 'The image must be in one of the following formats: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must be less than 2MB.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
