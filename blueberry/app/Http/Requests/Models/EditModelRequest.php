<?php

namespace App\Http\Requests\Models;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Models;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $models = Models::where('id',$this->id)->first();
        if(!$models){
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
        $brandId = $this->input('brand_id');
        $idToIgnore = $this->route('brands');

        return [
            'name' => [
                'string',
                'max:255',
                'required',
                Rule::unique('models')->ignore($this->id)->where(function ($query) {
                    $query->whereNull('deleted_at')
                    ->where('brand_id',$this->brand_id);
                }),
            ],
            'brand_id' => 'required|exists:brands,id',
            'status' => ['required'],
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'The name field is required.', // 'roles' is the name of your roles table
            'name.unique' => 'The car brand name must be unique and this car brand name already in use.', // 'roles' is the name of your roles table
            'status.required' => 'The status field is required.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
