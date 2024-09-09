<?php

namespace App\Http\Requests\Categories;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $feature = Category::where('id',$this->id)->first();
        if(!$feature){
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
            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->id)->where(function ($query) {

                    $query->where('feature_id',$this->feature_id)->whereNull('deleted_at');
                    if($this->has('parent_id')){
                        $query->where('parent_id',$this->parent_id);
                    }
                }),
            ],
            'status'=>['required'],
            'feature_id'=>['required'],
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The  name field is required.', // 'Feature' is the name of your roles table
            'name.unique' => 'The Category name must be unique and this role name already in use.', // 'Feature' is the name of your roles table
            'status.required' => 'The status field is required.', // 'Feature' is the status of your roles table
            'feature_id.required' => 'The feature field is required.', // 'Feature' is the status of your roles table
        ];
    }

    public function failedAuthorization()
    {
        // Custom message when authorization fails
        abort(401, 'Invalid Id');
    }
}
