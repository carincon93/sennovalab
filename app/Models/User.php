<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'email',
        'password',
        'tipo_documento',
        'numero_documento',
        'celular',
        'telefono',
        'extension',
        'estado',
        'autorizacion_tratamiento_datos',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship with UserInterno
     *
     * @return object
     */
    public function userInterno()
    {
        return $this->hasOne(UserInterno::class);
    }

    /**
     * Relationship with UserExterno
     *
     * @return object
     */
    public function userExterno()
    {
        return $this->hasOne(UserExterno::class);
    }

    /**
     * Filtrar registros
     *
     * @param  mixed $query
     * @param  mixed $filters
     * @return void
     */
    public function scopeFilterUser($query, array $filters)
    {
        // En el where reemplazar 'Nombre columna' por el nombre de la columna a filtrar
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('primer_nombre', 'like', '%' . $search . '%');
        });
    }

    /**
     * makePassword
     *
     * @param  mixed $numero_documento
     * @return void
     */
    public static function makePassword($numero_documento)
    {
        return bcrypt("sennovalab$numero_documento*");
    }

    public function getEstadoAttribute($value)
    {
        return $value == 0 ? 2 : 1;
    }
}
