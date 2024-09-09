<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
class AddCompanyRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->whereNull('deleted_at'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'requested_status' => 'nullable|string',
            'rejection_reason' => 'nullable|string',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_name' => 'nullable|string',
            'mobile_no' => [
                'required',
                'string',
                Rule::unique('users')->whereNull('deleted_at'),
            ],
            'country_code' => 'required|string',
            'role' => 'nullable|string',
            'company_role' => 'nullable|string',

            ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'is_company_account.required' => 'The is company account field is required.',
            'is_company_account.boolean' => 'The is company account field must be a boolean.',
            'requested_status.string' => 'The requested status must be a string.',
            'rejection_reason.string' => 'The rejection reason must be a string.',
            'logo.image' => 'The logo must be an image.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif.',
            'logo.max' => 'The logo may not be greater than 2048 kilobytes.',
            'company_name.string' => 'The company name must be a string.',
            'mobile_no.required' => 'The mobile number with country code is required.',
            'mobile_no.string' => 'The mobile number must be a string.',
            'mobile_no.regex' => 'Invalid mobile number format. It should start with a plus sign (+) followed by the country code and the actual number.',
            'role.string' => 'The role must be a string.',
            'company_role.string' => 'The company role must be a string.',

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }


}
