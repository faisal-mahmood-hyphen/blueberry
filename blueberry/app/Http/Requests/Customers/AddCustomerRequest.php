<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCustomerRequest extends FormRequest
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
    public function rules()
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
                'min:8',        // Minimum length of 8 characters// Must have a matching password confirmation field
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // Requires at least one lowercase, one uppercase, and one digit
            ],
            'status' => 'required', // Adjust to your specific statuses
            'gender' => 'required',
            'nationality' => 'required',
            'dob' => 'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one digit.',
            'status.required' => 'The status field is required.',
            'status.in' => 'Invalid value for the status field.',
            'gender.required' => 'Please select your gender.',
            'nationality.required' => 'The Nationality field is required.',
            'dob.required' => 'Please select your date of birth.',
            'image.image' => 'The image must be a valid image format (jpeg, png, jpg, gif).',
            'image.mimes' => 'The image must be in one of the following formats: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must be less than 2MB.',
        ];
    }
}
