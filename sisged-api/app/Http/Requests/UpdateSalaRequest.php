<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'Aula_idAula' => ['nullable', 'integer', 'exists:aula,idAula'],
            'nomeSala' => ['sometimes', 'required', 'string', 'max:50'],
            'capacidadeSala' => ['nullable', 'integer', 'min:1'],
            'tipoAula' => ['nullable', 'string', 'max:50'],
            'blocoandarAula' => ['nullable', 'string', 'max:50'],
        ];
    }
}
