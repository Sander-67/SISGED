<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCursoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'Turma_idTurma' => ['nullable', 'integer', 'exists:turma,idTurma'],
            'nomeCurso' => ['sometimes', 'required', 'string', 'max:100'],
            'modalidadeCurso' => ['nullable', 'string', 'max:50'],
            'cargahorariaCurso' => ['nullable', 'integer'],
            'nivelCurso' => ['nullable', 'integer'],
        ];
    }
}
