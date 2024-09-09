<?php

namespace App\Http\Requests\PropertyImages;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\Category;
use App\Models\PropertyImage;
use Illuminate\Foundation\Http\FormRequest;


class DeletePropertyImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $propertyImages = PropertyImage::where('id',$this->id)->first();
        if(!$propertyImages){
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
            'id' => [
                'required'
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The Id field is required.', // 'roles' is the name of your roles table
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
