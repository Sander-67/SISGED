<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAulaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'Administrador_idAdministrador' => ['nullable', 'integer', 'exists:administrador,idAdministrador'],
            'Aluno_idAluno' => ['nullable', 'integer', 'exists:aluno,idAluno'],
            'Materia_idMateria' => ['nullable', 'integer', 'exists:materia,idMateria'],
            'Turma_idTurma' => ['nullable', 'integer', 'exists:turma,idTurma'],
            'dataAula' => ['sometimes', 'required', 'date'],
            'horarioinicioAula' => ['nullable', 'date_format:H:i:s'],
            'horariofimAula' => ['nullable', 'date_format:H:i:s', 'after:horarioinicioAula'],
            'duracaoAula' => ['nullable', 'date_format:H:i:s'],
            'tipoAula' => ['nullable', 'string', 'max:50'],
            'statusAula' => ['nullable', 'boolean'],
        ];
    }
}
