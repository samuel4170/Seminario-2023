@extends('template')
@section('content-logged-in')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Colores</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <!-- Button trigger modal -->
                <button
                    type="button"
                    class="btn btn-primary btn-lg"
                    data-toggle="modal"
                    data-target="#new-modal-color">
                    <i class="fa fa-plus-circle"></i> Nuevo Registro
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Color</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter=1; ?>
                        @foreach ($colors as $color)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$color -> name}}</td>
                            <td>
                                <a href="{{ url('Edit-Color/' . $color -> id ) }}">
                                    <button class="btn btn-success" title="Actualizar">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </a>
                                <button class="btn btn-danger btn-delete-color" SpecieId="{{ $color -> id }}" title="Eliminar">
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
{{-- Modal Edit --}}
<div class="modal fade" id="edit-modal-color" tabindex="-1" aria-labelledby="edit-label-color">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="edit-label-color">Actualizar Color</h4>
        </div>
        <div class="modal-body">
            <form method="post" autocomplete="off" action="{{ url('Update-Color/'. $colorX -> id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{ $colorX -> name }}">
                    <small id="nameHelp" class="form-text text-muted">¿Cómo vas a nombrar este color a partir de ahora?</small>
                    @error('name')
                        <div class="alert alert-danger">Es posible que ya se haya registrado este color en el sistema.</div>
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
