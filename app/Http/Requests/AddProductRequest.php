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
            //
            'category_product_name' => 'required',
            'category_product_desc' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'category_name.required' => 'Vui long nhap ten danh muc',
            'category_desc.required' => 'Vui long nhap mo ta',
        ];
    }
}
