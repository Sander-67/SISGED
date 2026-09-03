<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdministradorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'usuarioAdministrador' => ['required', 'string', 'max:50', 'unique:administrador,usuarioAdministrador'],
            'emailAdministrador' => ['required', 'email', 'max:100', 'unique:administrador,emailAdministrador'],
            'senhaAdministrador' => ['required', 'string', 'min:8'],
        ];
    }
}
