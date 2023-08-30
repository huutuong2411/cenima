<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /* Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&"*()\-_=+{};:,<.>]).{6,255}+$/',

        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute Phải là dạng email',
            'min' => ':attribute có ít nhất :min ký tự',
            'regex' => ':attribute phải chứa chữ in hoa, ký tự đặc biệt'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
            'password' => 'mật khẩu',
        ];
    }
}
