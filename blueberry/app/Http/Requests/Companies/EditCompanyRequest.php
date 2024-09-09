<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class EditCompanyRequest extends FormRequest
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
        $rules = [
            'requested_status' => 'nullable|string',
            'company_role' => 'nullable|string',
        ];

        if ($this->input('requested_status') === 'rejected') {
            $rules['rejection_reason'] = 'required|string';
        } else {
            $rules['rejection_reason'] = 'nullable|string';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'requested_status.string' => 'The requested status must be a string.',
            'rejection_reason.required' => 'The rejection reason is required when the requested status is rejected.',
            'rejection_reason.string' => 'The rejection reason must be a string.',
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
