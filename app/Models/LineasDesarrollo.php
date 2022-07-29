<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineasDesarrollo extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'lineas_desarrollo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
        'id',
        'nombre',
        'created_at',
        'updated_at',

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
     * Relationship with FirstRelatedModel
     *
     * @return object
     */
    public function linea()
    {
        return $this->belongsTo(LineasDesarrollo::class);
    }

    /**
     * Relationship with SecondRelatedModel
     *
     * @return object
     */
/*    public function linea()
    {
        return $this->hasOne(LineasDesarrollo::class);
    } */

    /**
     * Filtrar registros
     *
     * @param  mixed $query
     * @param  mixed $filters
     * @return void
     */



    public function scopeFilterLineas($query, array $filters)
    {
        // En el where reemplazar 'Nombre columna' por el nombre de la columna a filtrar
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('nombre', 'like', '%'.$search.'%');
        });
    }
}
