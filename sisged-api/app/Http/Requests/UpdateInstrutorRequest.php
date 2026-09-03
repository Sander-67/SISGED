<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInstrutorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('instrutor')->idInstrutor ?? null;

        return [
            'Aula_idAula' => ['nullable', 'integer', 'exists:aula,idAula'],
            'nomeInstrutor' => ['sometimes', 'required', 'string', 'max:100'],
            'cpfInstrutor' => [
                'sometimes', 'required', 'integer', 'digits:11',
                Rule::unique('instrutor', 'cpfInstrutor')->ignore($id, 'idInstrutor'),
            ],
            'emailInstrutor' => [
                'sometimes', 'required', 'email', 'max:100',
                Rule::unique('instrutor', 'emailInstrutor')->ignore($id, 'idInstrutor'),
            ],
            'telefoneInstrutor' => ['nullable', 'integer'],
            'areaInstrutor' => ['nullable', 'string', 'max:50'],
            'statusInstrutor' => ['nullable', 'boolean'],
        ];
    }
}
