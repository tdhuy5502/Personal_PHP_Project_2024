<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginPostRequest extends FormRequest
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
            'admin_email' => 'required',
            'admin_password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'admin_email.required' => "Tai khoan khong duoc trong",
            'admin_password.required' => "Mat khau khong duoc trong"
        ];
    }
}
