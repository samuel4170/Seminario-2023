@extends('template')
@section('content-logged-in')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Registrar Paciente</h1>
        </section>
        <section class="content">
            <div class="box">
                <form method="post" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" name="name" id="name" class="form-control" required placeholder="Digita el nombre del paciente">
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
        </section>
    </div>
@endsection
