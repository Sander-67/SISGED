<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstrutorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'Aula_idAula' => ['nullable', 'integer', 'exists:aula,idAula'],
            'nomeInstrutor' => ['required', 'string', 'max:100'],
            'cpfInstrutor' => ['required', 'integer', 'digits:11', 'unique:instrutor,cpfInstrutor'],
            'emailInstrutor' => ['required', 'email', 'max:100', 'unique:instrutor,emailInstrutor'],
            'telefoneInstrutor' => ['nullable', 'integer'],
            'areaInstrutor' => ['nullable', 'string', 'max:50'],
            'statusInstrutor' => ['nullable', 'boolean'],
        ];
    }
}
