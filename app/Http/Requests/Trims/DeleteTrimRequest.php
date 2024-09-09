<?php

namespace App\Http\Requests\Trims;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Trim;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteTrimRequest extends FormRequest
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
