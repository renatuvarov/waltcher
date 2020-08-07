<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'st_nsp' => ['required', 'string', 'min:1', 'max:100'],
            'st_company' => ['nullable', 'string', 'min:1', 'max:50'],
            'st_email' => ['required', 'string', 'email', 'max:100'],
            'st_phone' => ['nullable', 'between:7,16'],
            'st_message' => ['required', 'string', 'min:10', 'max:255'],
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
            'st_nsp.required' => 'Обязательное поле.',
            'st_nsp.string' => 'Некорректное значение.',
            'st_nsp.min' => 'Некорректное значение.',
            'st_nsp.max' => 'Некорректное значение.',
            'st_company.string' => 'Некорректное значение.',
            'st_company.min' => 'Некорректное значение.',
            'st_company.max' => 'Некорректное значение.',
            'st_email.required' => 'Обязательное поле.',
            'st_email.string' => 'Некорректное значение.',
            'st_email.email' => 'Некорректный e-mail.',
            'st_email.max' => 'Некорректный e-mail.',
            'st_phone.between' => 'Некорректный номер.',
            'st_message.required' => 'Обязательное поле.',
            'st_message.string' => 'Некорректное значение.',
            'st_message.min' => 'Минимум 10 символов.',
            'st_message.max' => 'Максимум 255 символов.',
        ];
    }

    private function messagesEn()
    {
        return [
            'st_nsp.required' => 'This field is required.',
            'st_nsp.string' => 'This field is required.',
            'st_nsp.min' => 'Invalid value.',
            'st_nsp.max' => 'Invalid value.',
            'st_company.string' => 'This field is required.',
            'st_company.min' => 'Invalid value.',
            'st_company.max' => 'Invalid value.',
            'st_email.required' => 'This field is required.',
            'st_email.string' => 'This field is required.',
            'st_email.email' => 'Invalid e-mail.',
            'st_email.max' => 'Invalid e-mail.',
            'st_phone.between' => 'Invalid phone number.',
            'st_message.required' => 'This field is required.',
            'st_message.string' => 'Invalid value.',
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
