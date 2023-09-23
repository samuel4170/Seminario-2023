<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;
    protected $table = 'users'; //que tabla vamos a usar
    protected $fillable = [
        'name', 'email', 'password', 'id_consulting_room', 'genre', 'document', 'phone', 'role'
    ];

    public $timestamps = false;
    // Esta funcion trea una propiedad de la tabla Offices, basado en el valor de id_consulting_room
    // De esta forma, al pasarle el ID del consultorio al que pertenece el doctor, podemos saber el nombre del consultorio como tal
    public function CON(){
        return $this->belongsTo(Offices::class, 'id_consulting_room');
    }
}
