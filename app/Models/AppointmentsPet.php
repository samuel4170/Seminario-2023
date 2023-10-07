<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentsPet extends Model
{
    use HasFactory;

    protected $table = 'appointments_pet'; //que tabla vamos a usar
    protected $fillable = [ //indicar las propiedades/campos de la tabla
        'id_pet', 'vaccination_date', 'id_medicine', 'id_user', 'next_vaccination_date', 'status'
    ];

    public $timestamps = false; //Deshabilita registro de updates

    // Estas funciones permiten saber el valor de una propiedad @This de una @Tabla basado en el valor @Id
    // Uso: Obtener @Name de la tabla @Specie, basado en el valor de @id_specie
    public function GET_SPECIE()
    {
        return $this->belongsTo(Species::class, 'id_specie');
    }
    // Uso: Obtener @Name de la tabla @Breed, basado en el valor de @id_breed
    public function GET_BREED()
    {
        return $this->belongsTo(Breeds::class, 'id_breed');
    }
    // Uso: Obtener @Name de la tabla @Color, basado en el valor de @id_color
    public function GET_COLOR()
    {
        return $this->belongsTo(Colors::class, 'id_color');
    }
    // Uso: Obtener @Name de la tabla @Medicines, basado en el valor de @id_medicine
    public function GET_MEDICINE()
    {
        return $this->belongsTo(Medicines::class, 'id_medicine');
    }
    // Uso: Obtener @Name de la tabla @Users, basado en el valor de @id_user
    public function GET_USER()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    // Uso: Devuelve Hembra o Macho, dependiendo del valor de la propiedad pet_sex
    public function formattedPetSex()
    {
        return $this -> pet_sex == '1' ? 'Macho' : 'Hembra';
    }

    // Uso: Devolver la fecha de vacunacion de las mascotas/animales en un formato mas amigable
    public function formattedVaccinationDate()
    {
        $months =
        [   1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
            5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
            9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
        ];
        $vaccination_date = new DateTime($this -> vaccination_date);
        $day = $vaccination_date->format('j');
        $month = $months[intval($vaccination_date->format('n'))];
        $year = $vaccination_date->format('Y');
        return "$day de $month de $year";
    }

    // Uso: Devolver la fecha proxima de vacunacion de las mascotas/animales en un formato mas amigable
    public function formattedNextVaccinationDate()
    {
        $months =
        [   1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
            5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
            9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
        ];
        $next_vaccination_date = new DateTime($this -> next_vaccination_date);
        $day = $next_vaccination_date->format('j');
        $month = $months[intval($next_vaccination_date->format('n'))];
        $year = $next_vaccination_date->format('Y');
        return "$day de $month de $year";
    }

}
