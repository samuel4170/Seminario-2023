@extends('plantilla')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <h1>Horarios</h1>

        @if($horarios == null)

            <form method="post">

            @csrf

                <div class="row">

                    <div class="col-md-2">

                    Desde <input type="time" class="form-control" name="horaInicio">
                    
                    </div>

                    <div class="col-md-2">
                    Hasta <input type="time" class="form-control" name="horaFin">
                    </div>

                    <br>

                    <div class="col-md-1">

                        <button type="submit" class="btn btn-success">Guardar</button>

                    </div>

                </div>

            </form>

            @else

        @foreach($horarios as $hora)
            <form method="post" action="{{ url('editar-horario/'.$hora->id) }}">

            @csrf
            @method('put')

                <div class="row">

                    <div class="col-md-2">

                    Desde <input type="time" class="form-control" name="horaInicioE" value="{{ $hora->horaInicio }}">
                    
                    </div>

                    <div class="col-md-2">
                    Hasta <input type="time" class="form-control" name="horaFinE" value="{{ $hora->horaFin }}">
                    </div>

                    <br>

                    <div class="col-md-1">

                        <button type="submit" class="btn btn-success">Editar</button>

                    </div>

                </div>

            </form>

        @endforeach

        @endif
    </section>

    <section class="content">
        <div class="box">

            <div class="box-body">

                <div id="calendario"></div>

            </div>

        </div>
    </section>

</div>

@endsection