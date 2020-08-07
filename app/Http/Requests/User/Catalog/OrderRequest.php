<?php

namespace App\Http\Requests\User\Catalog;

use App\Dto\Catalog\Orders\Dto;
use App\Entities\Catalog\Machine;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $ids = implode(',', Machine::pluck('id')->toArray());

        return [
            'name' => ['required', 'string', 'min:1', 'max:100'],
            'company' => ['required', 'string', 'min:1', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'phone' => ['nullable', 'between:7,16'],
            'id' => ['required', 'integer', 'in:' . $ids],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'This field is required.',
            'name.string' => 'This field is required.',
            'name.min' => 'Invalid value.',
            'name.max' => 'Invalid value.',
            'company.required' => 'This field is required.',
            'company.string' => 'This field is required.',
            'company.min' => 'Invalid value.',
            'company.max' => 'Invalid value.',
            'email.required' => 'This field is required.',
            'email.string' => 'This field is required.',
            'email.email' => 'Invalid e-mail.',
            'email.max' => 'Invalid e-mail.',
            'phone.between' => 'Invalid phone number.',
            'id.required' => 'No equipment found.1',
            'id.integer' => 'No equipment found.2',
            'id.in' => 'No equipment found.3',
        ];
    }

    public function getDto(): Dto
    {
        return new Dto(
            $this->input('name'),
            $this->input('email'),
            $this->input('company'),
            $this->input('phone'),
            $this->input('id'),
        );
    }
}
