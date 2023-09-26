<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breeds extends Model
{
    use HasFactory;
    protected $table = 'breeds';
    protected $fillable = ['id_specie', 'name'];

    public $timestamps = false;

    // Esta funcion trea una propiedad de la tabla @Especie, basado en el valor de @id_specie
    // De esta forma, al pasarle el @ID de la @especie al que pertenece la @raza, podemos saber el @nombre de la @especie
    public function CON(){
        return $this->belongsTo(Species::class, 'id_specie');
    }
}
