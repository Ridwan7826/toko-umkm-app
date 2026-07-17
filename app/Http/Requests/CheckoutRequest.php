<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'courier' => 'required|string|in:JNE,J&T,Sicepat,Pos',
            'address' => 'required|array',
            'address.province' => 'required|string',
            'address.city' => 'required|string',
            'address.detail' => 'required|string',
        ];
    }
}
