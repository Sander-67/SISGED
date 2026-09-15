<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTurmaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $idTurma = $this->route('turma')->idTurma ?? null;

        return [
            'codigoTurma' => [
                'sometimes', 'required', 'integer',
                Rule::unique('turma', 'codigoTurma')->ignore($idTurma, 'idTurma'),
            ],
            'turnoTurma' => ['sometimes', 'required', 'string', 'max:50'],
            'datainicioTurma' => ['nullable', 'date'],
            'datafimTurma' => ['nullable', 'date', 'after_or_equal:datainicioTurma'],
        ];
    }
}
