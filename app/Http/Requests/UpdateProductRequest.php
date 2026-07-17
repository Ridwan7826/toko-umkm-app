<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'penjual';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_ids' => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Variasi
            'variants' => 'required|array|min:1',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.sku' => 'nullable|string|max:100',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.weight' => 'required|integer|min:1',
            'variants.*.stock' => 'required|integer|min:0',
        ];
    }
}
