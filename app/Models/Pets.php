<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    use HasFactory;
    protected $table = 'pets';
    protected $fillable = [
        'owner_name', 'owner_phone', 'owner_email',
        'pet_name', 'id_specie', 'id_breed', 'pet_sex', 'id_color', 'birthdate', 'add_info', 'status'
    ];

    public $timestamps = false;

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

    // Uso: Calcular la edad con base en la fecha de nacimiento de la mascota
    public function calculateAge()
    {
        $birthdate = new DateTime($this->birthdate); // Se obtiene la propiedad fecha de nacimiento del registro @pet que usa la funcion
        $currentDate = new DateTime(); // Se obtiene la fecha actual
        $ageYears = $birthdate->diff($currentDate)->y; // Se calcula la diferencia en años.
        $ageMonths = $birthdate->diff($currentDate)->m; // Se calcula la diferencia en meses.

        if ($ageYears == 1) { // 1 año
            return $ageYears . ' año';
        } elseif ($ageYears > 1) { // 3 años
            return $ageYears . ' años';
        }
        if ($ageYears == 0) { // 0 años seria muy feo, entonces retornar la edad en meses
            if ($ageMonths == 1) {
                return $ageMonths . ' mes'; //casi imposible, pero si se registrase una mascota, la edad podria ser 1 mes
            } else {
                return $ageMonths . ' meses'; //si es mayor a uno, se mostraria "2 meses"
            }
        }
    }

    // Uso: Devolver la fecha de nacimiento de las mascotas/animales en un formato mas amigable
    public function formattedBirthdate()
    {
        $months = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];
        $birthdate = new DateTime($this->birthdate);
        $day = $birthdate->format('j');
        $month = $months[intval($birthdate->format('n'))];
        $year = $birthdate->format('Y');
        return "$day de $month de $year";
    }

    // Uso: Devuelve Hembra o Macho, dependiendo del valor de la propiedad pet_sex
    public function formattedPetSex()
    {
        return $this -> pet_sex == '1' ? 'Macho' : 'Hembra';
    }
}
