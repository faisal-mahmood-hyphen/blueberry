<?php

namespace App\Http\Requests\Properties;

use App\Enums\PropertyPurposeEnum;
use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $property = Property::where('id',$this->property_id)->where('propertyPurpose',PropertyPurposeEnum::FOR_RENT)->first();
        if(!$property){
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
            'property_id'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'property_id.required' => 'The property id field is required.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Property Id');
    }
}
