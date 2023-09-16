@extends('plantilla')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h1>Editar registro del paciente: {{ $paciente->name}}</h1>
    </section>

    <section class="content">

        <div class="box">

            <div class="box-header">

                <a href="{{ url('Pacientes')}}">
                    
                    <button class="btn btn-primary">Volver a pacientes</button>
               
                </a>

            </div>

         <div class="box-body">

            <form method="post" action="{{ url('actualizar-paciente/'.$paciente->id) }}">

                @csrf

                @method('put')

                <h2>Nombre y apellido</h2>
                <input type="text" class="form-control input-lg" name="name" value="{{ $paciente->name}}">
                
                <h2>Email</h2>
                <input type="text" class="form-control input-lg" name="email" value="{{ $paciente->email}}">

                <h2>DPI</h2>
                <input type="text" class="form-control input-lg" name="DPI" value="{{ $paciente->DPI}}">

                <h2>Telefono</h2>
                <input type="text" class="form-control input-lg" name="telefono" value="{{ $paciente->telefono}}">

                <!-- <h2>Sexo</h2>
                <input type="text" class="form-control input-lg" name="sexo" value="{{ $paciente->sexo}}"> -->

                <h2>Genero:</h2>
                <select class="from-control input-lg" name="sexo" required="">

                        <option value="">Seleccionar</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                </select>


                <h2>Nueva Contraseña</h2>
                <input type="text" class="form-control input-lg" name="passwordN" value="">

                <input type="hidden" class="form-control input-lg" name="password" value="{{ $paciente->password}}">

                <br><br>

                <button class="btn btn-success" type="submit">Actualizar</button>

            </form>

         </div>
        </div>

    </section>

</div>


@endsection