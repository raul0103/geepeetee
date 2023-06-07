<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GptApiKeyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['max:255'],
            'key' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'key.required' => 'Ключ обязательн для заполнения',
        ];
    }
}
