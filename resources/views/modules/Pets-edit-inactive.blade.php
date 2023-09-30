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
                {{-- Modulo Inactive NO tiene boton de registro --}}
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
                                        <button class="btn btn-info">Activo</button>
                                    @else
                                        <button class="btn btn-warning">Inactivo</button>
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
{{-- Modal Edit --}}
<div class="modal fade" id="edit-modal-pet-inactive" tabindex="-1" aria-labelledby="edit-label-pet">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="edit-label-pet"><i class="fa fa-plus-circle"></i> Actualizar Mascota</h4>
        </div>
        <div class="modal-body">
            <form method="post" autocomplete="off" action="{{ url('Update-Pet-Inactive/'. $petX -> id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="owner_name" class="form-label">Nombre del Propietario:</label>
                    <input value="{{ $petX -> owner_name }}" type="text" name="owner_name" id="owner_name" class="form-control uppercase" required value="{{ old('owner_name') }}">
                    <small id="owner_nameHelp" class="form-text text-muted">¿Cómo se llama el propietario de la mascota?</small>
                    @error('owner_name')
                        <div class="alert alert-danger">Debes digitar correctamente el nombre del propietario.</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="owner_phone" class="form-label">Teléfono:</label>
                    <input value="{{ $petX -> owner_phone }}" type="number" name="owner_phone" id="owner_phone" class="form-control" required value="{{ old('owner_phone') }}" placeholder="00000000">
                    <small id="owner_phoneHelp" class="form-text text-muted">Número de teléfono o celular para contactar al cliente</small>
                    @error('owner_phone')
                        <div class="alert alert-danger">Debes digitar correctamente el Teléfono de contacto.</div>
                    @enderror
                </div>
                {{-- form-group opcional para @email --}}
                <button type="button" id="add-email" class="btn btn-dark" title="Opcional">Actualizar Correo Electrónico</button>
                <div id="optional-field-email">
                    {{-- El form-group para email se cargará dinámicamente aquí --}}
                </div>
                <hr>
                <div class="form-group">
                    <label for="pet_name" class="form-label">Nombre de la Mascota:</label>
                    <input value="{{ $petX -> pet_name }}" type="text" name="pet_name" id="pet_name" class="form-control uppercase" required value="{{ old('pet_name') }}">
                    <small id="pet_nameHelp" class="form-text text-muted">¿Cómo se llama la mascota?</small>
                    @error('pet_name')
                        <div class="alert alert-danger">Debes digitar correctamente el nombre de la mascota.</div>
                    @enderror
                </div>
                {{-- Select para especificar la especie de la mascota --}}
                <div class="form-group">
                    <label for="id_specie" class="form-label">Especie:</label>
                        <select name="id_specie" id="id_specie" class="form-control" required>
                            {{-- <option value="">-- Seleccione una opción --</option> --}}
                            @foreach ($species as $specie)
                                @if ($specie -> id == $petX -> id_specie)
                                    <option selected value="{{ $specie -> id }}">{{ $specie -> name}}</option>
                                @else
                                    <option value="{{ $specie -> id }}">{{ $specie -> name}}</option>
                                @endif
                            @endforeach
                        </select>
                    <small id="id_specieHelp" class="form-text text-muted">¿A qué especie pertenece la mascota?</small>
                    @error('id_specie')
                        <div class="alert alert-danger">Debes especificar correctamente la especie de la mascota</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_breed" class="form-label">Raza:</label>
                    <select name="id_breed" id="id_breed" class="form-control" required disabled>
                        <!-- Las opciones de raza se cargarán dinámicamente aquí si se cambia de especie -->
                    </select>
                    <small id="id_breedHelp" class="form-text text-muted">¿Cuál es la raza de la mascota?</small>
                    @error('id_breed')
                        <div class="alert alert-danger">Debes especificar correctamente la raza de la mascota</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_color" class="form-label">Color:</label>
                    <select name="id_color" id="id_color" class="form-control" required>
                        @foreach ($colors as $color)
                            <option value="{{ $color -> id }}">{{ $color -> name}}</option>
                            @if ($color -> id == $petX -> id_color)
                                <option value="{{ $color -> id }}" selected>{{ $color -> name}}</option>
                            @else
                                <option value="{{ $color -> id }}">{{ $color -> name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <small id="id_colorHelp" class="form-text text-muted">¿A qué especie pertenece la mascota?</small>
                    @error('id_color')
                        <div class="alert alert-danger">Debes especificar correctamente la especie de la mascota</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pet_sex" class="form-label">Sexo:</label>
                    <select name="pet_sex" id="pet_sex" class="form-control" required>
                            @if ($petX -> pet_sex == '1')
                                <option value="0">Hembra</option>
                                <option value="1" selected>Macho</option>
                            @else
                                <option value="0" selected>Hembra</option>
                                <option value="1">Macho</option>
                            @endif
                    </select>
                    <small id="pet_sexHelp" class="form-text text-muted">¿A qué sexo pertenece la mascota?</small>
                    @error('pet_sex')
                        <div class="alert alert-danger">Debes especificar correctamente el sexo de la mascota</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="birthdate" class="form-label">Fecha de Nacimiento:</label>
                    <input value="{{$petX -> birthdate}}" type="date" name="birthdate" id="birthdate" class="form-control" required value="{{ old('birthdate') }}">
                    <small id="birthdateHelp" class="form-text text-muted">Seleccione la fecha de nacimiento de la mascota</small>
                    @error('birthdate')
                        <div class="alert alert-danger">Debes digitar correctamente la fecha de nacimiento de la mascota</div>
                    @enderror
                </div>
                {{-- form-group opcional para @detalles_adicionales --}}
                <button type="button" id="add-info" class="btn btn-dark" title="Opcional">Actualizar Detalles Adicionales</button>
                <div id="optional-field-info">
                    {{-- El form-group para @detalles_adicionales se cargará dinámicamente aquí --}}
                </div>
                {{-- form group que actua como salto de linea --}}
                <div class="form-group"></div>
                <div class="form-group">
                    <label for="pet_status" class="form-label">Estado:</label>
                    <select name="pet_status" id="pet_status" class="form-control" required>
                            @if ($petX -> status == '1')
                            <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            @else
                            <option value="1">Activo</option>
                            <option value="0" selected>Inactivo</option>
                            @endif
                    </select>
                    <small id="pet_sexHelp" class="form-text text-muted">Activo significa que el propietario de la mascota es un cliente constante</small>
                    @error('pet_sex')
                        <div class="alert alert-danger">Debes especificar correctamente el estado del registro</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Actualizar</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
{{-- Importacion de Jquery para ejecutar codigo de abajo --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- Script para cargar dinámicamente las razas que corresponden a una especie de animal --}}
<script type="text/javascript">
    function handleGetBreeds(opt){
        // Obtener los elementos de los campos
        let $idSpecie = $('#id_specie');
        let $idBreed = $('#id_breed');

        let specieId = $(opt).val(); // Obtener el valor de la especie seleccionada
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
                    // Limpiar y cargar las opciones de razas
                    $idBreed.empty(); // Limpiar opciones anteriores
                    $.each(response, function(index, breed) {
                        $idBreed.append($('<option>', {
                            value: breed.id,
                            text: breed.name
                        }));
                    });
                    // Seleccionar el valor actual almacenada en @raza
                    $idBreed.val('{{ $petX -> id_breed }}');
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
    }

    $(document).ready(function() {
        // Taer las razas de la especie que la mascota tiene registrada actualmente
        handleGetBreeds($('#id_specie'));

        // Detectar el cambio en el campo de selección de especies
        $('#id_specie').change(function() {
            let $idSpecie = $('#id_specie');
            let $idBreed = $('#id_breed');
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
{{-- Script para mostrar de una forma más amigable la fecha de nacimiento de la mascota --}}
<script>
    // Obtener el elemento input y el div donde se mostrará la fecha formateada
    let inputDate = document.getElementById('birthdate');
    let birthdateHelp = document.getElementById('birthdateHelp');

    // Agregar un evento de cambio al elemento input
    inputDate.addEventListener('change', function() {
        // Definir los nombres de los meses
        let month = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        selectedDate = new Date(this.value);

        // Desmenuzar la fecha
        selectedDay = selectedDate.getDate() + 1; //Validar si en el lado del cliente hay que agregarle o no un uno.
        selectedMonth = month[selectedDate.getMonth()];
        selectedYear = selectedDate.getFullYear();

        // Formatear la fecha en el formato deseado
        let formatedDate = selectedDay + ' de ' + selectedMonth + ' de ' + selectedYear;

        // Mostrar la fecha formateada en el elemento help
        birthdateHelp.textContent = formatedDate;
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
                        @if ($petX -> owner_email == '(Sin registrar)')
                            <input placeholder="{{ $petX -> owner_email }}" type="email" name="owner_email" id="owner_email" class="form-control" value="{{ old('owner_email') }}" placeholder="ejemplo@gmail.com">
                        @else
                        <input value="{{ $petX -> owner_email }}" type="email" name="owner_email" id="owner_email" class="form-control" value="{{ old('owner_email') }}" placeholder="ejemplo@gmail.com">
                        @endif
                        <button type="button" class="btn btn-danger remove-field-email" title="Eliminar Correo Electrónico"><i class="fa fa-trash"></i></button>
                    </div>
                    <small id="owner_emailHelp" class="form-text text-muted">Dirección de correo electrónico para contactar al cliente</small>
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
                        @if ($petX -> add_info == '(No hay detalles adicionales)')
                            <input placeholder="{{$petX -> add_info}}" type="text" name="add_info" id="add_info" class="form-control" value="{{ old('add_info') }}">
                        @else
                            <input value="{{$petX -> add_info}}" type="text" name="add_info" id="add_info" class="form-control" value="{{ old('add_info') }}">
                        @endif
                        <button type="button" class="btn btn-danger remove-field-info" title="Eliminar Datos Adicionales"><i class="fa fa-trash"></i></button>
                    </div>
                    <small id="add_infoHelp" class="form-text text-muted">¿Alguna observación o detalle con relación a la mascota?</small>
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
