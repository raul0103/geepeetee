<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GptCommonSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'temperature' => 'nullable|in:0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,1.0',
            'max_tokens' => 'nullable|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'temperature.in' => 'temperature: Доступные значения [0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,1.0]',
            'max_tokens.numeric' => 'max_tokens: Не является числом',
            'max_tokens.min' => 'max_tokens: Меньше нуля'
        ];
    }
}
