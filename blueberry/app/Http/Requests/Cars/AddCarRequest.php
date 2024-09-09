<?php

namespace App\Http\Requests\Cars;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCarRequest extends FormRequest
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
            'title' => ['required',],
            'year' => ['required', 'date_format:Y', 'before_or_equal:' . now()->year,],
            'mileage' => 'required|numeric',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
            'country_id' => 'required',
            'regional_specs' => 'required',
            'is_car_insured' => 'required',
            'view_360_url' => 'required|url',
            'fuel_type' => 'required',
            'body_condition' => 'required',
            'mechanical_condition' => 'required',
            'exterior_color' => 'required',
            'interior_color' => 'required',
            'warranty' => 'required',
            'doors' => 'required',
            'cylinders' => 'required',
            'transmission_type' => 'required',
            'seating_capacity' => 'required',
            'horse_power' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'trim_id' => 'required',
            'body_type_id' => 'required',
            'price' => 'required',
            'phone' => 'required',
            'description' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!is_null($value)) {
                        $lines = substr_count($value, "\n") + 1;
                        if ($lines > 5) {
                            $fail("The $attribute must be 5 lines or less.");
                        }
                    }
                },
            ],


        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'year.required' => 'The year field is required.',
            'year.date_format' => 'The year must be a valid date in the format YYYY.',
            'year.before_or_equal' => 'The year cannot be in the future.',
            'mileage.required' => 'The mileage field is required.',
            'mileage.numeric' => 'The mileage must be in numbers.',
            'image.image' => 'The image must be a valid image format (jpeg, png, jpg, gif).',
            'image.mimes' => 'The image must be in one of the following formats: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must be less than 2MB.',
            'country_id.required' => 'The country field is required.',
            'regional_specs.required' => 'The regional specs field is required.',
            'is_car_insured.required' => 'The car insured field is required.',
            'view_360_url.required' => 'The 360-degree view URL field is required.',
            'view_360_url.url' => 'The 360-degree view URL must be a valid URL.',
            'fuel_type.required' => 'The fuel type field is required.',
            'body_condition.required' => 'The body condition field is required.',
            'mechanical_condition.required' => 'The mechanical condition field is required.',
            'exterior_color.required' => 'The exterior color field is required.',
            'interior_color.required' => 'The interior color field is required.',
            'warranty.required' => 'The warranty field is required.',
            'doors.required' => 'The doors field is required.',
            'cylinders.required' => 'The cylinders field is required.',
            'transmission_type.required' => 'The transmission type field is required.',
            'seating_capacity.required' => 'The seating capacity field is required.',
            'horse_power.required' => 'The horse power field is required.',
            'brand_id.required' => 'The brand field is required.',
            'model_id.required' => 'The model field is required.',
            'trim_id.required' => 'The trim field is required.',
            'body_type_id.required' => 'The body type field is required.',
            'phone.required' => 'The phone field is required.',
            'price.required' => 'The price field is required.',
        ];
    }

}
