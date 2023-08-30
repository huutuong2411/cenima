<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute có nhiều nhất :max ký tự',
            'email' => ':attribute Phải là dạng email',
            'min' => ':attribute có ít nhất :min ký tự',
            'confirmed' => 'nhập lại :attribute không đúng',
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
