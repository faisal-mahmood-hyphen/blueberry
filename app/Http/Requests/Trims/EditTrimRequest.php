<?php

namespace App\Http\Requests\Trims;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Trim;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditTrimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $trims = Trim::where('id',$this->id)->first();
        if(!$trims){
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
            'trims' => [
                'required',
                'string',
                'max:255',
                Rule::unique('trims')->ignore($this->id)->where(function ($query) {
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
            'trims.required' => 'The name field is required.',
            'trims.unique' => 'The trim name  and this trim name already in use.',
            'status.required' => 'The status field is required.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
