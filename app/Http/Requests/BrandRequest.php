<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'brand_product_name' => 'required',
            'brand_product_desc' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'brand_product_name.required' => 'Vui long nhap ten danh muc',
            'brand_product_desc.required' => 'Vui long nhap mo ta',
        ];
    }
}
