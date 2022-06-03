<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExterno extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'user_externo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_cliente',
        'tipo_usuario',
        'empresa_centro_formacion',
        'nit_rut',
        'digito_verificacion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Relationship with User
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Filtrar registros
     *
     * @param  mixed $query
     * @param  mixed $filters
     * @return void
     */
    public function scopeFilterUserInterno($query, array $filters)
    {
        // En el where reemplazar 'Nombre columna' por el nombre de la columna a filtrar
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->join('users', 'user_externo.user_id', 'users.id');
            $query->where('users.primer_nombre', 'like', '%' . $search . '%');
        });
    }

    /**
     * Get codigo e.g. SLAB-0001-2022
     *
     * @return string
     */
    public static function makeCodigo($id, $year)
    {
        $year = date('Y', strtotime($year));
        $numeroConsecutivo = sprintf("%04s", $id);
        $codigo = 'CLI-' . $numeroConsecutivo . '-' . $year;

        return $codigo;
    }
}
