<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontendLoginRequest extends FormRequest
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
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_pass' => 'required',
            'customer_phone' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required' => 'Vui long dien ten cua ban !',
            'customer_email.required' => 'Email khong duoc de trong !',
            'customer_pass.required' => 'Hay dien mat khau cua ban !',
            'customer_phone.required' => 'Vui long them so dien thoai !'
        ];
    }
}
