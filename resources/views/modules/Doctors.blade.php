@extends('template')
@section('content-logged-in')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Doctores</h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <!-- Button trigger modal -->
                <button
                    type="button"
                    class="btn btn-primary btn-lg"
                    data-toggle="modal"
                    data-target="#newDoctorModal">
                    <i class="fa fa-plus-circle"></i> Registrar Doctor
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Completo</th>
                            <th>Consultorio</th>
                            <th>Email</th>
                            <th>Documento</th>
                            <th>Teléfono</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter=1; ?>
                        @foreach ($doctors as $doctor)
                            @if ($doctor-> role == "Doctor")
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>{{$doctor -> name}}o</td>
                                    <td>
                                        {{$doctor->CON->office}}
                                    </td>
                                    <td>{{$doctor -> email}}</td>
                                    @if ($doctor -> document != '')
                                        <td>{{$doctor -> document}}</td>
                                    @else
                                        <td> Aún no registrado. </td>
                                    @endif
                                    @if ($doctor -> phone != '')
                                        <td>{{$doctor -> phone}}</td>
                                    @else
                                        <td> Aún no registrado. </td>
                                    @endif
                                    <td>
                                        <button class="btn btn-danger deleteDoctorBtn" DoctorId="{{ $doctor -> id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="newDoctorModal" tabindex="-1" aria-labelledby="newDoctorLabel">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="newDoctorLabel"><i class="fa fa-plus-circle"></i> Registrar Doctor</h4>
    </div>
    <div class="modal-body">
        <form method="post" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" required>
                <small id="nameHelp" class="form-text text-muted"></small>
                @error('name')
                    <div class="alert alert-danger">Debes especificar el nombre del doctor</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="genre" class="form-label">Género:</label>
                <select name="genre" id="genre" class="form-control" required>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                </select>
                @error('genre')
                    <div class="alert alert-danger">Debes especificar el género del doctor</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="office" class="form-label">Consultorio:</label>
                <select name="id_consulting_room" id="office" class="form-control" required>
                    @foreach ($offices as $office)
                        <option value="{{ $office -> id }}">{{ $office -> office}}</option>
                    @endforeach
                </select>
                @error('id_consulting_room')
                    <div class="alert alert-danger">Debes especificar el Consultorio del doctor</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="text" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                <small id="emailHelp" class="form-text text-muted"></small>
                @error('email')
                    <div class="alert alert-danger">El correo electrónico ya ha sido registrado.</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" required>
                <small id="passwordHelp" class="form-text text-muted"></small>
                @error('password')
                <div class="alert alert-danger">La contraseña debe tener al menos 4 letras</div>
                @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
    </div>
</div>
</div>
@endsection
