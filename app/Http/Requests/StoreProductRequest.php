<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_content' => 'required',
            'product_price' => 'required',
            'product_image' => 'required',
            'product_quantity' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Vui long nhap ten SP',
            'product_desc.required' => 'Vui long nhap mo ta',
            'product_content.required' => 'Vui long nhap chi tiet SP',
            'product_price.required' => 'Vui long nhap gia SP',
            'product_image.required' => 'Vui long chon anh SP',
            'product_quantity.required' => 'Vui long nhap so luong quan ly'
        ];
    }
}
