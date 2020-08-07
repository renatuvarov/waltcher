<?php

namespace App\Http\Requests\Admin\Catalog\Properties;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:properties',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле обязательно для заполнения',
            'name.string' => 'Значение этого поля должно быть строкой',
            'name.min' => 'Длина не менее 3 символов',
            'name.unique' => 'Такой параметр уже существует',
        ];
    }
}
