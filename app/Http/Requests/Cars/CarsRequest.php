<?php

namespace App\Http\Requests\Cars;

use App\Enums\StatusEnum;
use App\Models\Feature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $feature = Feature::where('id',$this->feature_id)->where('status',StatusEnum::ACTIVE)->first();
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
            'feature_id'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'feature_id.required' => 'The feature id field is required.', // 'Feature' is the name of your roles table
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Car Id');
    }
}
