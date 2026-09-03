<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTurmaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'codigoTurma' => ['required', 'integer'],
            'turnoTurma' => ['required', 'string', 'max:50'],
            'datainicioTurma' => ['nullable', 'date'],
            'datafimTurma' => ['nullable', 'date', 'after_or_equal:datainicioTurma'],
        ];
    }
}
