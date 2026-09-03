<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAlunoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $idAluno = $this->route('aluno')->idAluno ?? null;

        return [
            'nomeAluno' => ['sometimes', 'required', 'string', 'max:100'],
            'cpfAluno' => [
                'sometimes', 'required', 'integer', 'digits:11',
                Rule::unique('aluno', 'cpfAluno')->ignore($idAluno, 'idAluno'),
            ],
            'emailAluno' => [
                'sometimes', 'required', 'email', 'max:100',
                Rule::unique('aluno', 'emailAluno')->ignore($idAluno, 'idAluno'),
            ],
            'telefoneAluno' => ['nullable', 'integer'],
        ];
    }
}
