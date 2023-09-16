@extends('plantilla')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Gestor de animales</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header">
                <a href="Crear-Paciente">
                   <button class="btn btn-primary btn-lg">Agregar mascota</button>
                </a>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>DPI</th>
                            <th>Telefono</th>
                            <th>Sexo</th>
                            <th>borrar / editar</th>


                        </tr>
                    </thead>

                <tbody>

                    @foreach($pacientes as $paciente)
                    <tr>
                        <td>{{ $paciente->id }}</td>
                        <td>{{ $paciente->name }}</td>
                        <td>{{ $paciente->email }}</td>
                        <td>{{ $paciente->DPI }}</td>
                        <td>{{ $paciente->telefono }}</td>
                        

                        @if($paciente->sexo != "")

                            <td>{{ $paciente->sexo }}</td>
                       
                        @else

                            <td>No Disponible</td>

                        @endif
                            <td>

                                <a href="Editar-Paciente/{{ $paciente->id }}">

                                <button class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                
                            </a>

                                <button class="btn btn-danger EliminarPaciente" Pid="{{ $paciente->id }}" Paciente="{{ $paciente->name }}"><i class="fa fa-trash"></i>
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

@endsection
