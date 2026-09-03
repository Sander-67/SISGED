<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMateriaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'siglaMateria' => ['nullable', 'string', 'max:20'],
            'nomeMateria' => ['sometimes', 'required', 'string', 'max:100'],
            'cargahorariaMateria' => ['nullable', 'date_format:H:i:s'],
            'ementaMateria' => ['nullable', 'string', 'max:255'],
        ];
    }
}
