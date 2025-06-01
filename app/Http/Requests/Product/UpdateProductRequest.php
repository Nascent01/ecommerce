<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' =>  'required|string|max:255',
            'slug' =>  ['nullable', 'string', 'max:255', Rule::unique('products')->ignore($this->product)],
            'sku' =>  ['required', 'string', 'max:255', Rule::unique('products')->ignore($this->product)],
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'product_category_ids' => 'nullable|array',
            'product_category_ids.*' => 'exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'slug.unique' => 'The slug has already been taken',
            'is_active.boolean' => 'The is_active field must be true or false',
            'sku.required' => 'A SKU is required',
            'sku.unique' => 'The SKU has already been taken',
            'product_category_ids.array' => 'The product categories must be an array',
            'product_category_ids.*.exists' => 'One or more selected product categories do not exist',
            'image.image' => 'The image must be a valid image file',
        ];
    }
}
