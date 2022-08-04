<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'servicios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo_servicio',
        'descripcion_necesidad',
        'user_externo_id',
        'tipo_servicio_id',
        'categoria_linea_desarrollo_id'

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
     * Relationship with UserExterno
     *
     * @return object
     */
    public function userExterno()
    {
        return $this->belongsTo(UserExterno::class);
    }

    /**
     * Relationship with TipoServicio
     *
     * @return object
     */
    public function tipoServicio()
    {
        return $this->belongsTo(TipoServicio::class);
    }

    /**
     * Relationship with CategoriaLineaDesarrollo
     *
     * @return object
     */
    public function categoriaLineaDesarrollo()
    {
        return $this->belongsTo(CategoriaLineaDesarrollo::class);
    }

    /**
     * Filtrar registros
     *
     * @param  mixed $query
     * @param  mixed $filters
     * @return void
     */
    public function scopeFilterServicio($query, array $filters)
    {
        // En el where reemplazar 'Nombre columna' por el nombre de la columna a filtrar
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('descripcion_necesidad', 'like', '%' . $search . '%');
        });
    }
}
