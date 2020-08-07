<?php

namespace App\Http\Requests\Admin\Blog\Categories;;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_ru' => 'nullable|string|min:3|max:30|unique:categories,name_ru,' . $this->category->id . ',id',
            'name_en' => 'nullable|string|min:3|max:30|unique:categories,name_en,' . $this->category->id . ',id',
            'slug' => 'nullable|string|min:3|max:30|unique:categories,slug,' . $this->category->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'name_ru.string' => 'Некорректное значение',
            'name_ru.min' => 'Минимум 3 символа',
            'name_ru.max' => 'Максимум 30 символов',
            'name_ru.unique' => 'Такое наименование уже существует',

            'name_en.string' => 'Некорректное значение',
            'name_en.min' => 'Минимум 3 символа',
            'name_en.max' => 'Максимум 30 символов',
            'name_en.unique' => 'Такое наименование уже существует',

            'slug.required' => 'Обязательный параметр',
            'slug.string' => 'Некорректное значение',
            'slug.min' => 'Минимум 3 символа',
            'slug.max' => 'Максимум 30 символов',
            'slug.unique' => 'Такое наименование уже существует',
        ];
    }
}
