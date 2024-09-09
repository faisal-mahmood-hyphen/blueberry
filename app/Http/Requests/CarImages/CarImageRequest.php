<?php

namespace App\Http\Requests\CarImages;

use App\Enums\StatusEnum;
use App\Models\CarImage;
use App\Models\Feature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $carimages = CarImage::where('id',$this->car_image_id)->first();
        if(!$carimages){
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
            'car_image_id'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'car_image_id.required' => 'The car image id field is required.', // 'Feature' is the name of your roles table
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Car Id');
    }
}
