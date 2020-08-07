<?php

namespace App\Http\Requests\Admin\Catalog\Tags;

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
            'name' => 'required|string|min:3|unique:tags',
            'slug' => 'nullable|string|min:3|unique:tags',
            'img' => 'required|file|max:512|mimes:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле обязательно для заполнения',
            'name.string' => 'Значение этого поля должно быть строкой',
            'name.min' => 'Длина не менее 3 символов',
            'name.unique' => 'Такой тэг уже существует',

            'slug.string' => 'Значение этого поля должно быть строкой',
            'slug.min' => 'Длина не менее 3 символов',
            'slug.unique' => 'Такой слаг уже существует',

            'img.required' => 'Изображение не добавлено',
            'img.file' => 'Некорректный формат изображения',
            'img.max' => 'Максимальный размер изображения - 0.5 мегабайт',
            'img.mimes' => 'Некорректный формат изображения',
        ];
    }
}
