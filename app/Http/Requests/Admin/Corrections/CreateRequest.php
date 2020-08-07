<?php

namespace App\Http\Requests\Admin\Corrections;

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
            'correction_from' => 'required|string|min:1',
            'correction_to' => 'required|string|min:1',
            'correction_comment' => 'nullable|string|min:1',
            'correction_url' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            'correction_from.required' => 'Обязательный параметр.',
            'correction_from.string' => 'Некорректный параметр.',
            'correction_from.min' => 'Минимальная длина - 1 символ.',

            'correction_to.required' => 'Обязательный параметр.',
            'correction_to.string' => 'Некорректный параметр.',
            'correction_to.min' => 'Минимальная длина - 1 символ.',

            'correction_comment.string' => 'Некорректный параметр.',
            'correction_comment.min' => 'Минимальная длина - 1 символ.',

            'correction_url.required' => 'Обязательный параметр.',
            'correction_url.url' => 'Некорректный адрес.',
        ];
    }
}
