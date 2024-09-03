<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class ClientStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'max:190'],
            'email' => ['nullable', 'email:dns', 'max:254',  Rule::requiredIf(empty($this->phone))],
            'phone' => ['nullable', 'regex:/^[0-9+\s]*$/', Rule::requiredIf(empty($this->email))],
            'address' => ['nullable'],
            'city' => ['nullable'],
            'postcode' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
