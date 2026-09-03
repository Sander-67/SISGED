<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Aula",
 *     type="object",
 *     title="Aula",
 *     required={"dataAula"},
 *     @OA\Property(property="idAula", type="integer", example=1, readOnly=true),
 *     @OA\Property(property="Administrador_idAdministrador", type="integer", example=1),
 *     @OA\Property(property="Aluno_idAluno", type="integer", example=1),
 *     @OA\Property(property="Materia_idMateria", type="integer", example=1),
 *     @OA\Property(property="Turma_idTurma", type="integer", example=1),
 *     @OA\Property(property="dataAula", type="string", format="date", example="2026-03-10"),
 *     @OA\Property(property="horarioinicioAula", type="string", example="19:00:00"),
 *     @OA\Property(property="horariofimAula", type="string", example="22:00:00"),
 *     @OA\Property(property="duracaoAula", type="string", example="03:00:00"),
 *     @OA\Property(property="tipoAula", type="string", example="Prática"),
 *     @OA\Property(property="statusAula", type="boolean", example=true)
 * )
 */
class Aula extends Model
{
    protected $table = 'aula';
    protected $primaryKey = 'idAula';

    protected $fillable = [
        'Administrador_idAdministrador',
        'Aluno_idAluno',
        'Materia_idMateria',
        'Turma_idTurma',
        'dataAula',
        'horarioinicioAula',
        'horariofimAula',
        'duracaoAula',
        'tipoAula',
        'statusAula',
    ];

    protected $casts = [
        'statusAula' => 'boolean',
    ];

    public function administrador()
    {
        return $this->belongsTo(Administrador::class, 'Administrador_idAdministrador', 'idAdministrador');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'Aluno_idAluno', 'idAluno');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'Materia_idMateria', 'idMateria');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'Turma_idTurma', 'idTurma');
    }

    public function instrutores()
    {
        return $this->hasMany(Instrutor::class, 'Aula_idAula', 'idAula');
    }

    public function salas()
    {
        return $this->hasMany(Sala::class, 'Aula_idAula', 'idAula');
    }
}
