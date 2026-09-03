<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTurmaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'codigoTurma' => ['sometimes', 'required', 'integer'],
            'turnoTurma' => ['sometimes', 'required', 'string', 'max:50'],
            'datainicioTurma' => ['nullable', 'date'],
            'datafimTurma' => ['nullable', 'date', 'after_or_equal:datainicioTurma'],
        ];
    }
}
