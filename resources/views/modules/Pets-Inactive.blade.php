@extends('template')
@section('content-logged-in')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Mascotas Inactivas</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <!-- Button trigger modal -->
                {{-- En este modulo no se permitira registrar --}}
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre (Propietario)</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Nombre (Mascota)</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Color</th>
                            <th>Sexo</th>
                            <th>Fecha de Nacimiento (Mascota)</th>
                            <th>Edad (Mascota)</th>
                            <th>Datos Adicionales</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter=1; ?>
                        @foreach ($pets as $pet)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$pet -> owner_name}}</td>
                                <td>{{$pet -> owner_phone}}</td>
                                <td>{{$pet -> owner_email}}</td>
                                <td>{{$pet -> pet_name}}</td>
                                <td>{{$pet -> GET_SPECIE -> name }}</td>
                                <td>{{$pet -> GET_BREED -> name }}</td>
                                <td>{{$pet -> GET_COLOR -> name }}</td>
                                <td>{{$pet -> formattedPetSex()}}</td>
                                <td>{{$pet -> formattedBirthdate()}}</td>
                                <td>{{$pet -> calculateAge()}}</td>
                                <td>{{$pet -> add_info}}</td>
                                <td>
                                    @if($pet->status == 1)
                                        <button class="btn btn-info" disabled>Activo</button>
                                    @else
                                        <button class="btn btn-warning" disabled>Inactivo</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('Edit-Pet-Inactive/' . $pet -> id ) }}">
                                        <button class="btn btn-success" title="Actualizar datos de la mascota">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btn-delete-pet" PetId="{{ $pet -> id }}" title="Eliminar datos de la Mascota">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </section>
</div>
{{-- Importacion de Jquery para ejecutar codigo de abajo --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- Script para cargar dinámicamente las razas que corresponden a una especie de animal --}}
<script type="text/javascript">
    $(document).ready(function() {
        // Obtener los elementos de los campos
        let $idSpecie = $('#id_specie');
        let $idBreed = $('#id_breed');

        // Inicialmente, deshabilitar el campo id_breed
        $idBreed.prop('disabled', true);

        // Detectar el cambio en el campo de selección de especies
        $idSpecie.change(function() {
            let specieId = $(this).val(); // Obtener el valor de la especie seleccionada

            // Habilitar o deshabilitar el campo id_breed según si se seleccionó una especie o no
            if (specieId !== '') {
                // Si se selecciona una especie, habilitar el campo id_breed
                $idBreed.prop('disabled', false);
                $idBreed.empty();//limpiar posibles datos anteriores
                // Realizar una solicitud AJAX para obtener las razas correspondientes
                $.ajax({
                    url: 'http://localhost/citagro_demo/public/Pets/Get-Breeds-Specie/'+ specieId, // Ruta que manejará la obtención de razas
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        // Limpiar y cargar las opciones de razas
                        $idBreed.empty(); // Limpiar opciones anteriores
                        $.each(response, function(index, breed) {
                            $idBreed.append($('<option>', {
                                value: breed.id,
                                text: breed.name
                            }));
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
            } else {
                // Si no se selecciona una especie, deshabilitar el campo id_breed y borrar sus opciones
                $idBreed.prop('disabled', true);
                $idBreed.empty();
            }
        });
    });
</script>
{{-- Scrip para mostrar dinamicamente los campos opcinales: correo del cliente y detalles adicinales mascota --}}
<script>
    $(document).ready(function() {
        // Botón "Agregar Correo Electrónico"
        $('#add-email').click(function() {
            $(this).hide();
            let emailFieldHTML = `
                <div class="form-group optional-field-email">
                    <label for="owner_email" class="form-label">Correo electrónico</label>
                    <div class="optional-field-style">
                        <input type="email" name="owner_email" id="owner_email" class="form-control" value="{{ old('owner_email') }}" placeholder="ejemplo@gmail.com">
                        <button type="button" class="btn btn-danger remove-field-email" title="Cancelar Registro de Correo Electrónico"><i class="fa fa-window-close"></i></button>
                    </div>
                    <small id="owner_emailHelp" class="form-text text-muted">Dirección de correo electrónico para contactar al propietario de la mascota</small>
                    @error('owner_email')
                        <div class="alert alert-danger">Debes digitar correctamente el correo electrónico.</div>
                    @enderror
                </div>
            `;
            $('#optional-field-email').append(emailFieldHTML);
        });

        // Botón "Cancelar Registro de Correo Electrónico"
        $('#optional-field-email').on('click', '.remove-field-email', function() {
            $(this).closest('.form-group').remove();
            $('#add-email').show();
        });

        // Botón "Agregar Detalles Adicionales"
        $('#add-info').click(function() {
            $(this).hide();
            let addInfoFieldHTML = `
                <div class="form-group optional-field-info">
                    <label for="add_info" class="form-label">Datos Adicionales:</label>
                    <div class="optional-field-style">
                        <input type="text" name="add_info" id="add_info" class="form-control" value="{{ old('add_info') }}">
                        <button type="button" class="btn btn-danger remove-field-info" title="Cancelar Registro de Datos Adicionales"><i class="fa fa-window-close"></i></button>
                    </div>
                    <small id="add_infoHelp" class="form-text text-muted">¿Alguna observación o detalle adicional con relación a la mascota?</small>
                    @error('add_info')
                        <div class="alert alert-danger">Debes digitar alto relevante en los detalles adicionales de la mascota</div>
                    @enderror
                </div>
            `;
            $('#optional-field-info').append(addInfoFieldHTML);
        });

        // Botón "Cancelar Registro de Datos Adicionales"
        $('#optional-field-info').on('click', '.remove-field-info', function() {
            $(this).closest('.form-group').remove();
            $('#add-info').show();
        });
    });
</script>
{{-- Script para convertir el texto digitado en inputs a mayusculas --}}
<script>
    // Agrega un manejador de eventos para convertir el texto en mayúsculas mientras se escribe
    document.querySelectorAll('.uppercase').forEach(function(input) {
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });
</script>
@endsection
