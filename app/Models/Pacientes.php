<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name','email','password','DPI','telefono','sexo','id_consultorio','rol'
    ];

    public $timestamps = false;
}
