<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdministradorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('administrador')->idAdministrador ?? null;

        return [
            'usuarioAdministrador' => [
                'sometimes', 'required', 'string', 'max:50',
                Rule::unique('administrador', 'usuarioAdministrador')->ignore($id, 'idAdministrador'),
            ],
            'emailAdministrador' => [
                'sometimes', 'required', 'email', 'max:100',
                Rule::unique('administrador', 'emailAdministrador')->ignore($id, 'idAdministrador'),
            ],
            'senhaAdministrador' => ['sometimes', 'required', 'string', 'min:8'],
        ];
    }
}
