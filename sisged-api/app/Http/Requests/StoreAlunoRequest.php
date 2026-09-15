<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlunoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomeAluno' => ['required', 'string', 'max:100'],
            'cpfAluno' => ['required', 'integer', 'digits:11', 'unique:aluno,cpfAluno'],
            'emailAluno' => ['required', 'email', 'max:100', 'unique:aluno,emailAluno'],
            'telefoneAluno' => ['nullable', 'integer'],
            'senhaAluno' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'nomeAluno.required' => 'O nome do aluno é obrigatório.',
            'cpfAluno.required' => 'O CPF é obrigatório.',
            'cpfAluno.digits' => 'O CPF deve conter 11 dígitos.',
            'cpfAluno.unique' => 'Já existe um aluno cadastrado com este CPF.',
            'emailAluno.required' => 'O e-mail é obrigatório.',
            'emailAluno.email' => 'Informe um e-mail válido.',
            'emailAluno.unique' => 'Já existe um aluno cadastrado com este e-mail.',
            'senhaAluno.required' => 'A senha é obrigatória.',
            'senhaAluno.min' => 'A senha deve ter no mínimo 8 caracteres.',
        ];
    }
}
