<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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


         'name'=>'required|string',
         'price' => 'required|numeric|min:0|max:999999.99',
         'description'=>'string',
         'Is_trend'=>'boolean',
         'category_name'=>'exists:categories,name',
         'image'=>'nullable|mimes:jpg,png,gif|'
            //
        ];
    }
}
