@extends('template')
@section('content-logged-in')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Medicamentos</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <!-- Button trigger modal -->
                <button
                    type="button"
                    class="btn btn-primary btn-lg"
                    data-toggle="modal"
                    data-target="#new-modal-medicine">
                    <i class="fa fa-plus-circle"></i> Nuevo Registro
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- Imagen de referencia = Medicamento --}}
                            <th></th>
                            <th>Nombre</th>
                            <th>(Q) Precio</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter=1;
                            define("DEFAULT_MEDICINE_IMG", "http://localhost/citagro_demo/public/dist/img/default_medicine_img.png");
                        ?>
                        @foreach ($medicines as $medicine)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>
                                    <img src="<?= DEFAULT_MEDICINE_IMG ?>" alt="Default Image Medicine" style="max-width: 40px">
                                </td>
                                <td>{{$medicine -> name}}</td>
                                <td>{{$medicine -> price}}</td>
                                <td>
                                    <a href="{{ url('Edit-Medicine/' . $medicine -> id ) }}">
                                        <button class="btn btn-success" title="Actualizar">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-danger btn-delete-medicine" MedicineId="{{ $medicine -> id }}" title="Eliminar">
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
<div class="modal fade" id="edit-modal-medicine" tabindex="-1" aria-labelledby="edit-label-medicine">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="edit-label-medicine">Actualizar Medicamento</h4>
        </div>
        <div class="modal-body">
            <form method="post" autocomplete="off" action="{{ url('Update-Medicine/'. $medicineX -> id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" required value="{{ $medicineX -> name }}">
                    <small id="nameHelp" class="form-text text-muted">¿Cómo vas a identificar este medicamento a partir de ahora?</small>
                    @error('name')
                        <div class="alert alert-danger">Ya exisre un medicamento con el nombre '{{ old('name')}}'</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price" class="form-label">Precio:</label>
                    <input type="text" name="price" id="price" class="form-control" required value="{{ $medicineX -> price }}" placeholder="0.00">
                    <small id="priceHelp" class="form-text text-muted">Digite el nuevo precio del medicamento en Quetzales</small>
                    @error('price')
                        <div class="alert alert-danger">Debes especificar el precio correctamente.</div>
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
