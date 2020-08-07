<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class PropertiesNotEmpty implements Rule
{
    /**
     * @param Request $request
     */
    private $request;

    /**
     * Create a new rule instance.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->request->properties as $property) {
            if (count($property) < 2) {
                return false;
            }

            foreach ($property as $item) {
                if (is_null($item)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Параметр не может быть пустым.';
    }
}
