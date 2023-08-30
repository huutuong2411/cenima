<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'email' => 'required|email',
            'address' => 'required',
            'password' => 'required|min:6|regex:/^(?=(.*[0-9]))(?=.*[!@#$%^&*()\[\]{}\-=~`|:;"\'<>,.\/?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*))[A-Za-z\d!@#$%^&*()\[\]{}\-=~`|:;"\'<>,.\/?]{8,}$/',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute có nhiều nhất :max ký tự',
            'email' => ':attribute Phải là dạng email',
            'regex' => ':attribute không hợp lệ',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
            'phone' => 'số điện thoại',
            'address' => 'địa chỉ',
        ];
    }
}
