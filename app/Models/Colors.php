<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    use HasFactory;

    protected $table = 'colors'; //que tabla vamos a usar
    protected $fillable = [ //indicar las propiedades/campos de la tabla
        'name'
    ];

    public $timestamps = false; //Deshabilita registro de updates
}
