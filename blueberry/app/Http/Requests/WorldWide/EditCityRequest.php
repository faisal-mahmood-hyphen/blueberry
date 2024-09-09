<?php

namespace App\Http\Requests\WorldWide;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $city = City::where('id',$this->id)->where('state_id',$this->state_id)->first();
        if(!$city){
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
            'status.in' => 'Invalid value for the status field.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
