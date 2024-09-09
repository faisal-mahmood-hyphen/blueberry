<?php

namespace App\Http\Requests\WorldWide;

use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $country = Country::where('id',$this->id)->first();
        if(!$country){
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'status' => 'required', // Adjust to your specific statuses
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'This field is required.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
