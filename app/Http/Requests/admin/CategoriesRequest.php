<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
        ];
    }
}
