@extends('plantilla')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h1>Registrar Paciente</h1>
    </section>

    <section class="content">

    <div class="box">

        <div class="box-body">
            <form method="post">
                @csrf

                    <div class="form-group">
                        <h2>Nombre y Apellido:</h2>
                        <input type="text" name="name" class="form-control input-lg" required>
                    </div>

                    <div class="form-group">
                        <h2>Telefono:</h2>
                        <input type="text" name="telefono" class="form-control input-lg" required>
                    </div>

                    <div class="form-group">
                        <h2>Genero:</h2>

                        <select class="from-control input-lg" name="sexo" required="">

                            <option value="">Seleccionar</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Masculino">Masculino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <h2>DPI:</h2>
                        <input type="text" name="DPI" class="form-control input-lg" required>
                    </div>

                    <div class="form-group">
                        <h2>Correo Electronico:</h2>
                        <input type="email" class="form-control input-lg" name="email" value="{{
                        old('email') }}">

                            @error('email')
                            <div class="alert alert-danger">El Email ya esta registrado..</div>
                            
                            @enderror
                    </div>

                    <div class="form-group">
                        <h2>contraseña</h2>
                        <input type="text" name="password" class="form-control input-lg" required>
                    </div>

                    <br>

                <button type="submit" class="btn btn-primary btn-lg">Agregar</button>
            </form>

        </div>
        </div>

    </section>

</div>

@endsection