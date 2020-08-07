<?php

namespace App\Http\Requests\User\Search;

use App\Entities\Catalog\Tag;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $ids = implode(',', Tag::pluck('id')->toArray());

        return [
            'st_title' => 'nullable|string|min:3|max:255',
            'st_categories.*' => 'nullable|integer|in:' . $ids,
        ];
    }

    public function messages()
    {
        $prefix = config('site.user.routes.prefix.name');

        return $prefix === substr($this->route()->getName(), 0, strlen($prefix))
            ? $this->messagesRu()
            : $this->messagesEn();
    }

    private function messagesRu()
    {
        return [
            'st_title.string' => 'Некорректное значение.',
            'st_title.min' => 'Некорректное значение.',
            'st_title.max' => 'Некорректное значение.',
            'st_categories.*.integer' => 'Оборудование не найдено.',
            'st_categories.*.in' => 'Оборудование не найдено.',
        ];
    }

    private function messagesEn()
    {
        return [
            'st_title.string' => 'Invalid value.',
            'st_title.min' => 'Invalid value.',
            'st_title.max' => 'Invalid value.',
            'st_categories.*.integer' => 'Invalid value.',
            'st_categories.*.in' => 'No equipment found.',
        ];
    }

//    public function failedValidation(Validator $validator) {
//        throw new HttpResponseException(response()->json($validator->errors(), 422));
//    }
}
