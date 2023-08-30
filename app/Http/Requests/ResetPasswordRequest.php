<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&"*()\-_=+{};:,<.>]).{6,255}+$/|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute có nhiều nhất :max ký tự',
            'regex' => ':attribute phải chứa ký tự đặc biệt và In Hoa',
            'confirmed' => 'nhập lại :attribute không đúng',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Mật khẩu',
        ];
    }
}
