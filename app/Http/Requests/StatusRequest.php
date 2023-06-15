<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'import_id' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'import_id.required' => 'Не введен ID импорта',
        ];
    }
}
