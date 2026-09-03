<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     schema="Aluno",
 *     type="object",
 *     title="Aluno",
 *     required={"nomeAluno", "cpfAluno", "emailAluno"},
 *     @OA\Property(property="idAluno", type="integer", example=1, readOnly=true),
 *     @OA\Property(property="nomeAluno", type="string", example="Maria Silva"),
 *     @OA\Property(property="cpfAluno", type="integer", format="int64", example=12345678900),
 *     @OA\Property(property="emailAluno", type="string", format="email", example="maria.silva@email.com"),
 *     @OA\Property(property="telefoneAluno", type="integer", format="int64", example=31998765432, nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
 *     @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
 * )
 */
class Aluno extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'aluno';
    protected $primaryKey = 'idAluno';

   protected $fillable = [
    'nomeAluno',
    'cpfAluno',
    'emailAluno',
    'telefoneAluno',
    'senhaAluno',
];

protected $hidden = [
    'senhaAluno',
];

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'Aluno_idAluno', 'idAluno');
    }
}
