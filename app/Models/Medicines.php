<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    use HasFactory;

    protected $table = 'medicines'; //que tabla vamos a usar
    protected $fillable = [ //indicar las propiedades/campos de la tabla
        'name', 'price'
    ];

    public $timestamps = false; //Deshabilita registro de updates
}
