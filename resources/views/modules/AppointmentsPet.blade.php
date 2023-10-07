@extends('template')
@section('content-logged-in')
<?php
use Carbon\Carbon;

// Codigo necesario para obtener la fecha actual mas 30 dias, por ejemplo:
// El usuario llega el 30/10/2023, por lo regular debe llegar nuevamente el 30/11/2023 (un mes despues)
// Obtener la fecha actual
$currentDate = Carbon::now();
// Calcular la fecha del mes siguiente
$nextDate = $currentDate->addMonth();
// Formatear la fecha del mes siguiente en el formato necesario (Y-m-d)
$formattedNextDate = $nextDate->format('Y-m-d');

$currentPetData =   $currentPet -> pet_name . ", " .
                    $currentPet -> GET_SPECIE -> name . " " .
                    $currentPet -> GET_BREED -> name . ", " .
                    $currentPet -> formattedPetSex() . ", color " .
                    $currentPet -> GET_COLOR -> name;
?>
{{-- Codigo para mostrar el historial actual de vacunacion de una mascota --}}
<div class="content-wrapper">
    <section class="content-header">
        <h1>Carné de Vacunación de <u>{{$currentPet -> pet_name}}</u></h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                {{-- Boton para regresar --}}
                <a href="{{ url('Pets/') }}" class="form-group pull-right">
                    <button class="btn btn-warning">
                        <i class="fa fa-backward"></i> <b> Regresar al módulo de mascotas</b>
                    </button>
                </a>
                <div class="form-group">
                    <p><b>Especie: </b>{{ $currentPet -> GET_SPECIE -> name }}</p>
                    <p><b>Raza: </b>{{ $currentPet -> GET_BREED -> name }}</p>
                    <p><b>Sexo: </b>{{ $currentPet -> formattedPetSex() }}</p>
                    <p><b>Color: </b>{{ $currentPet -> GET_COLOR -> name }}</p>
                    <p><b>Fecha de Nacimiento: </b>{{ $currentPet -> formattedBirthdate() }}</p>
                    <p><b>Propietario: </b>{{ $currentPet -> owner_name }}</p>
                    <p><b>Teléfono: </b>{{ $currentPet -> owner_phone }}</p>
                </div>
                <!-- Button trigger modal -->
                <button
                    type="button"
                    class="btn btn-primary btn-lg"
                    data-toggle="modal"
                    data-target="#new-modal-appointmentpet">
                    <i class="fa fa-plus-circle"></i> Registrar Datos de Vacunación
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">#</th>
                            <th class="text-center align-middle">Fecha</th>
                            <th class="text-center align-middle">Producto/Medicamento</th>
                            <th class="text-center align-middle">Responsable</th>
                            <th class="text-center align-middle">Próxima Vacuna</th>
                            <th class="text-center align-middle">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- php snippets vs code --}}
                        <?php $count = 1; ?>
                        @foreach ($appointments as $appointment)
                        <tr>
                            <td class="text-center align-middle">{{ $count++ }}</td>
                            <td class="text-center align-middle">{{ $appointment -> formattedVaccinationDate() }}</td>
                            <td class="text-center align-middle">{{ $appointment -> GET_MEDICINE -> name }}</td>
                            <td class="text-center align-middle">{{ $appointment -> GET_USER -> name }}</td>
                            <td class="text-center align-middle">{{ $appointment -> formattedNextVaccinationDate() }}</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-danger btn-delete-AppointmentPet" AppointmentPetId="{{ $appointment -> id }}" PetId="{{ $currentPet -> id }}" title="Eliminar Registro">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
{{-- Modal New Appointment --}}
<div class="modal fade" id="new-modal-appointmentpet" tabindex="-1" aria-labelledby="new-label-appointmentpet">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="new-label-appointmentpet"><i class="fa fa-plus-circle"></i> Registrar Datos de Vacunación</h4>
        </div>
        <div class="modal-body">
        {{-- No es necesario el action, basta con agregar method=post para que lo gestione web.php --}}
            <form method="post" autocomplete="off">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="id_pet">Detalles generales de la mascota:</label>
                    <input type="text" value="{{ $currentPetData }}" class="form-control" required disabled>
                    <input type="hidden" name="id_pet" value="{{ $currentPet -> id }}">
                    @error('id_pet')
                        <div class="alert alert-danger">Deben de incluirse los detalles de la mascota.</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="vaccination_date" class="form-label">Fecha:</label>
                    <input type="date" name="vaccination_date" id="vaccination_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    <small id="vaccination_dateHelp" class="form-text text-muted">[llenado dinamico]</small>
                    @error('vaccination_date')
                        <div class="alert alert-danger">En este campo debe indicarse la fecha actual.</div>
                    @enderror
                </div>
                {{-- Select para especificar el medicamento o producto suministrado a la mascota --}}
                <div class="form-group">
                    <label for="id_medicine" class="form-label">Producto | Medicamento:</label>
                    <select name="id_medicine" id="id_medicine" class="form-control" required>
                        @foreach ($medicines as $medicine)
                        <option value="{{ $medicine -> id }}">{{ $medicine -> name}}</option>
                        @endforeach
                    </select>
                    <small id="id_medicineHelp" class="form-text text-muted">¿Qué producto o medicamento se le suministró a la mascota?</small>
                    @error('id_medicine')
                        <div class="alert alert-danger">Debes especificar el producto o medicamento suministrado a la mascota.</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_user" class="form-label">Responsable:</label>
                    <input type="text" id="id_user" class="form-control" value="{{ auth() -> user() -> name }}" required disabled>
                    <input type="hidden" name="id_user" value="{{ auth() -> user() -> id }}">
                    <small id="id_userHelp" class="form-text text-muted">Este dato se adjunta con fines de consulta parta saber quién hizo el registro</small>
                    @error('id_user')
                        <div class="alert alert-danger">Debes especificar el responsable de hacer este registro.</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="next_vaccination_date" class="form-label">Próxima Vacuna:</label>
                    <input type="date" name="next_vaccination_date" id="next_vaccination_date" class="form-control" value="{{ $formattedNextDate }}" required>
                    <small id="next_vaccination_dateHelp" class="form-text text-muted">Selecciona la fecha próxima de vacunación.</small>
                    @error('next_vaccination_date')
                        <div class="alert alert-danger">En este campo debe indicarse la fecha próxima de vacunación.</div>
                    @enderror
                </div>
                {{-- form group que actua como salto de linea --}}
                <div class="form-group"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Registrar</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
{{-- Importacion de libreria para mensajes kwai --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function valid_currentDate(date) {
        const selectedDate = new Date(date);
        selectedDate.setDate(selectedDate.getDate() + 1); // Suma un día a la fecha seleccionada, bug en servidor aparece un dia menos.
        const currentDate = new Date();
        // Formatear ambas fechas como cadenas de texto con solo año, mes y día
        const selectedDateString = selectedDate.toLocaleDateString();
        const currentDateString = currentDate.toLocaleDateString();
        //console.log('valid_Date',selectedDateString, currentDateString);
        // Comparar las fechas y mostrar la alerta si la fecha seleccionada no es igual a la fecha actual
        if (selectedDateString !== currentDateString) {
            Swal.fire({
                text: 'En este apartado se debe de indicar la fecha actual.',
                icon: 'warning',
                confirmButtonText: 'De acuerdo'
            });
            return false;
        }
        return true;
    }

    function valid_futureDate(date) {
        const selectedDate = new Date(date);
        selectedDate.setDate(selectedDate.getDate() + 1); // Suma un día a la fecha seleccionada, bug en servidor aparece un dia menos.
        const currentDate = new Date();
        currentDate.setDate(currentDate.getDate() + 1);
        // Formatear ambas fechas como cadenas de texto con solo año, mes y día
        const selectedDateString = selectedDate.toLocaleDateString();
        const currentDateString = currentDate.toLocaleDateString();
        //console.log('valid_Date',selectedDateString, currentDateString);
        // Comparar las fechas y mostrar la alerta si la fecha seleccionada es menor o igual a la fecha actual
        if (selectedDate <= currentDate) {
            Swal.fire({
                text: 'En este apartado se debe de indicar una fecha futura.',
                icon: 'warning',
                confirmButtonText: 'De acuerdo'
            });
            return false;
        }
        return true;
    }

</script>
{{-- Script para formatear la fecha próxima de vacunación a un formato más legible --}}
<script>
    function getFormattedDate(date, type = 'next') {
        // Si se envia la fecha de tipo current (para el caso de un nuevo registro de vacunacion)
        if (type == 'current') {
            if (!valid_currentDate(date)) { // validamos la fecha
                let tmp = document.getElementById('vaccination_date'); //temporalemnte obtenemos el input
                tmp.value = "{{ date('Y-m-d') }}"; // Se le asigna nuevamente la fecha actual
                date = new Date(tmp.value); // sea cual sea la fecha que se haya elegido, le volvemos a setear la fecha actual
            }
        }else if(type == 'next'){
            if(!valid_futureDate(date)){
                let tmp = document.getElementById('next_vaccination_date');
                tmp.value = "{{ $formattedNextDate }}"; // Se le asigna nuevamente la fecha futuro por default
                date = new Date(tmp.value);//sea cual sea la fecha que se haya elegido, le volvemos a setear la fecha futuro por default
            }
        }

        // Definir los nombres de los meses
        let month = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

        // Desmenuzar la fecha
        let selectedDay = date.getDate() + 1; //Validar si en el lado del cliente hay que agregarle o no un uno.
        let selectedMonth = month[date.getMonth()];
        let selectedYear = date.getFullYear();

        // Formatear la fecha en el formato deseado
        return selectedDay + ' de ' + selectedMonth + ' de ' + selectedYear;
    }

    // Obtener el elemento input y el div donde se mostrará la fecha formateada
    let next_vaccination_date = document.getElementById('next_vaccination_date');
    let next_vaccination_dateHelp = document.getElementById('next_vaccination_dateHelp');

    // Función para actualizar la fecha formateada
    function updateFormattedDate() {
        let selectedDate = new Date(next_vaccination_date.value);
        let formattedDate = getFormattedDate(selectedDate);
        next_vaccination_dateHelp.textContent = formattedDate;
    }

    // Agregar un evento de cambio al elemento input
    next_vaccination_date.addEventListener('change', updateFormattedDate);

    // Llamar a la función inicialmente para el valor predeterminado
    updateFormattedDate();

    // Para la fecha actual, tanbien se presenta la fecha en un formato mas legible
    let vaccination_date = document.getElementById('vaccination_date');
    let vaccination_dateHelp = document.getElementById('vaccination_dateHelp');

    // Definimos la funcion para hacer el cambio
    function updateVaccinationDate(){
        let selectedDate = new Date(vaccination_date.value);
        let formattedDate = getFormattedDate(selectedDate, 'current');
        vaccination_dateHelp.textContent = formattedDate;
    }

    // Agregar un evento de cambio al elemento input
    vaccination_date.addEventListener('change', updateVaccinationDate);

    // Ejecutamos la funcion como tal
    updateVaccinationDate();
</script>
@endsection
