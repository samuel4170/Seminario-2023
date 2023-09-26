<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;
    protected $table = 'species'; //que tabla vamos a usar
    protected $fillable = [ //indicar las propiedades
        'name'
    ];

    public $timestamps = false;
}
