<?php

namespace App\Http\Requests\PropertyImages;

use App\Enums\StatusEnum;
use App\Models\CarImage;
use App\Models\Feature;
use App\Models\PropertyImage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $propertyimages = PropertyImage::where('id',$this->property_image_id)->first();
        if(!$propertyimages){
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
            'property_image_id'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'property_image_id.required' => 'The car image id field is required.', // 'Feature' is the name of your roles table
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Car Id');
    }
}
