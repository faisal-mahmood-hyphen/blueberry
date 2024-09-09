<?php

namespace App\Http\Requests\CarImages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCarImageRequest extends FormRequest
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
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'required',
            'make_primary' => 'required',
            'car_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'The image must be a valid image format (jpeg, png, jpg, gif).',
            'image.mimes' => 'The image must be in one of the following formats: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must be less than 2MB.',
            'make_primary.required' => 'The make primary field is required.',
            'car_id.required' => 'The car_id field is required.',

        ];
    }

}
