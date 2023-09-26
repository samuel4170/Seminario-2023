@extends('template')
@section('content-logged-in')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Razas</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <!-- Button trigger modal -->
                <button
                    type="button"
                    class="btn btn-primary btn-lg"
                    data-toggle="modal"
                    data-target="#new-modal-breed">
                    <i class="fa fa-plus-circle"></i> Nuevo Registro
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter=1; ?>
                        @foreach ($breeds as $breed)
                            <tr>
                                <td>{{$counter++}}</td>
                                {{-- CON toma el valor de id_secie y consulta el nombre de la especie --}}
                                <td>{{$breed -> CON -> name }}</td>
                                <td>{{$breed -> name}}</td>
                                <td>
                                    <a href="{{ url('Edit-Breed/' . $breed -> id ) }}">
                                        <button class="btn btn-success" title="Actualizar">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btn-delete-breed" BreedId="{{ $breed -> id }}" title="Eliminar">
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
<div class="modal fade" id="edit-modal-breed" tabindex="-1" aria-labelledby="edit-label-breed">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="edit-label-breed"><i class="fa fa-plus-circle"></i> Actualizar Raza</h4>
        </div>
        <div class="modal-body">
            <form method="post" autocomplete="off" action="{{ url('Update-Breed/'. $breedX -> id) }}">
                @csrf
                @method('put')
                {{-- Select para especificar la especie de la raza --}}
                <div class="form-group">
                    <label for="id_specie" class="form-label">Especie:</label>
                    <select name="id_specie" id="id_specie" class="form-control" required>
                        @foreach ($species as $specie)
                            {{-- Si el id de la especie que estamos recorriendo, es igual al id actual de la especie que tiene la raza --}}
                            @if ($specie -> id == $breedX -> id_specie)
                                {{-- Entonces le asignamos la propiedad "selected" para que aparezca seleccionada esa opcion por default --}}
                                <option value="{{ $specie -> id }}" selected>{{ $specie -> name}}</option>
                            @else
                                {{-- Caso contrario no se le agrega dicha propiedad --}}
                                <option value="{{ $specie -> id }}">{{ $specie -> name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <small id="id_specieHelp" class="form-text text-muted">¿A que especie pertenece la raza?</small>
                    @error('id_consulting_room')
                        <div class="alert alert-danger">Debes especificar la especie de la raza</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{ $breedX -> name }}">
                    <small id="nameHelp" class="form-text text-muted">¿Cómo vas a nombrar esta raza a partir de ahora?</small>
                    @error('name')
                        <div class="alert alert-danger">Es posible que ya se haya registrado esta raza.</div>
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
@endsection
