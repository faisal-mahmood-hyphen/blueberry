<?php

namespace App\Http\Requests\Trims;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddTrimRequest extends FormRequest
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
            'trims' => [
                'required',
                'string',
                'max:255',
                Rule::unique('trims')->where(function ($query) {
                    $query->whereNull('deleted_at')
                    ->where('brand_id',$this->brand_id)
                    ->where('model_id',$this->model_id);

                }),
            ],
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:models,id',
            'status'=>['required']
        ];
    }

    public function messages()
    {
        return [
            'trims.required' => 'The trim field is required.',
            'status.required' => 'The status field is required.',
        ];
    }
}
