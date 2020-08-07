<?php

namespace App\Http\Requests\Admin\Catalog\Machines;

use App\Entities\Catalog\Machine;
use App\Rules\PropertiesNotEmpty;
use App\Rules\UniqueValues;
use App\Traits\GetMachineDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class CreateRequest extends FormRequest
{
    use GetMachineDto;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $types = implode(',', array_keys(Machine::getTypes()));

        return [
            'tags.*' => ['required', 'integer', 'exists:tags,id', new UniqueValues($this, 'tags')],
            'properties' => [new PropertiesNotEmpty($this)],
            'properties.*.name' => ['required', 'integer', 'exists:properties,id', new UniqueValues($this)],
            'properties.*.value' => 'required|string|min:1',
            'name' => 'required|string|min:3|unique:machines',
            'short_name' => 'required|string|min:3|unique:machines',
            'slug' => 'nullable|string|min:3|unique:machines',
            'img' => 'required|file|max:512|mimes:jpeg,jpg,png',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'short_description' => 'required|string|min:10',
            'meta_description' => 'nullable|string|min:10|max:255',
            'description' => 'required|string|min:3',
            'mail' => 'required|string|min:3',
            'images.*' => 'nullable|string',
            'gallery_id' => 'nullable|integer|exists:galleries,id',
            'type' => 'required|string|in:' . $types,
        ];
    }

    public function messages()
    {
        return [
            'properties.*.name.required' => 'Это поле обязательно для заполнения.',
            'properties.*.name.integer' => 'Значение должно быть целым числом.',
            'properties.*.name.exists' => 'Неизвестный параметр.',

            'properties.*.value.required' => 'Это поле обязательно для заполнения.',
            'properties.*.value.string' => 'Значение этого поля должно быть строкой.',
            'properties.*.value.min' => 'Длина не менее 1 символа',

            'tags.*.required' => 'Это поле обязательно для заполнения.',
            'tags.*.integer' => 'Значение должно быть целым числом.',
            'tags.*.exists' => 'Неизвестный тэг.',

            'name.required' => 'Это поле обязательно для заполнения',
            'name.string' => 'Значение этого поля должно быть строкой',
            'name.min' => 'Длина не менее 3 символов',
            'name.unique' => 'Такое наименование уже существует',

            'short_name.required' => 'Это поле обязательно для заполнения',
            'short_name.string' => 'Значение этого поля должно быть строкой',
            'short_name.min' => 'Длина не менее 3 символов',
            'short_name.unique' => 'Такое наименование уже существует',

            'short_description.required' => 'Обязательный параметр',
            'short_description.string' => 'Некорректное значение',
            'short_description.min' => 'Минимум 10 символов',

            'meta_description.max' => 'Максимум 255 символов',
            'meta_description.string' => 'Некорректное значение',
            'meta_description.min' => 'Минимум 10 символов',

            'description.required' => 'Это поле обязательно для заполнения',
            'description.string' => 'Значение этого поля должно быть строкой',
            'description.min' => 'Длина не менее 3 символов',

            'mail.required' => 'Это поле обязательно для заполнения',
            'mail.string' => 'Значение этого поля должно быть строкой',
            'mail.min' => 'Длина не менее 3 символов',

            'slug.string' => 'Значение этого поля должно быть строкой',
            'slug.min' => 'Длина не менее 3 символов',
            'slug.unique' => 'Такой слаг уже существует',

            'img.required' => 'Изображение не добавлено',
            'img.file' => 'Некорректный формат изображения',
            'img.max' => 'Максимальный размер изображения - 0.5 мегабайт',
            'img.mimes' => 'Некорректный формат изображения',

            'pdf.file' => 'Некорректный формат',
            'pdf.max' => 'Максимальный размер изображения - 10 мегабайт',
            'pdf.mimes' => 'Некорректный формат',

			'gallery_id.integer' => 'Значение должно быть целым числом.',
            'gallery_id.exists' => 'Неизвестная галлерея.',

            'type.required' => 'Это поле обязательно для заполнения.',
            'type.string' => 'Значение этого поля должно быть строкой.',
            'type.in' => 'Неизвестный тип.',
        ];
    }
}
