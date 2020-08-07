<?php

namespace App\Http\Requests\Admin\Common\Galleries;

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
            'name' => 'required|string|max:50|unique:galleries',
            'images' => 'required|array',
            'images.*' => 'nullable|file|max:1024|mimes:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Обязательное поле.',
            'name.string' => 'Некорректное значение.',
            'name.max' => 'Максимальная длинна - 50 символов.',
            'name.unique' => 'Галерея с таким названием уже сущесвует.',

            'images.required' => 'Изображения не добавлены.',
            'images.array' => 'Изображения не добавлены.',

            'images.*.file' => 'Некорректное значение.',
            'images.*.max' => 'Максимальный размер файла - 1 мегабайт.',
            'images.*.mimes' => 'Допустимые форматы файлов: jpeg, jpg, png.',
        ];
    }
}
