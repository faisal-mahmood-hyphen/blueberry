<?php

namespace App\Http\Requests\B2b;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditB2BRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = User::where('id',$this->id)->first();
        if(!$user){
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
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)->whereNull('deleted_at'),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',        // Minimum length of 8 characters// Must have a matching password confirmation field
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', // Requires at least one lowercase, one uppercase, and one digit
            ],
            'status' => 'required', // Adjust to your specific statuses
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
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
