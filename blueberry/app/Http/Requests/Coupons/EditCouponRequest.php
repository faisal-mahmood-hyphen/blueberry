<?php

namespace App\Http\Requests\Coupons;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $coupon = Coupon::where('id',$this->id)->first();
        if(!$coupon){
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
            'coupons' => [
                'required',
                Rule::unique('coupons')->whereNull('deleted_at')->ignore($this->id),
                'regex:/^[A-Za-z0-9]+$/',
                'min:8',
            ],
            'validity' => [
                'required',
            ],
            'no_of_uses' => [
                'required',
                'integer',
            ],
        ];
    }

    public function messages()
    {
        return [
            'coupons.required' => 'The coupons field is required.',
            'coupons.unique' => 'The coupons field must be unique.',
            'coupons.regex' => 'The coupons field must only contain alphabets and numbers.',
            'coupons.min' => 'The coupons field must be at least 8 characters long.',
            'validity.required' => 'The validity field is required.',
            'validity.date_format' => 'The validity field must be in the correct date-time format.',
            'no_of_uses.required' => 'The no of uses field is required.',
            'no_of_uses.integer' => 'The no of uses field must be an integer.',
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
