<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     schema="Administrador",
 *     type="object",
 *     title="Administrador",
 *     @OA\Property(property="idAdministrador", type="integer", example=1),
 *     @OA\Property(property="usuarioAdministrador", type="string", example="admin"),
 *     @OA\Property(property="emailAdministrador", type="string", example="admin@sisged.com")
 * )
 */
class Administrador extends Model
{
    use HasApiTokens, Notifiable;

    protected $table = 'Administrador';
    protected $primaryKey = 'idAdministrador';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'usuarioAdministrador',
        'emailAdministrador',
        'senhaAdministrador',
    ];

    protected $hidden = [
        'senhaAdministrador',
    ];
}