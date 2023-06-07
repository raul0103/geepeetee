<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GptParserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Файл не выбран',
        ];
    }
}
