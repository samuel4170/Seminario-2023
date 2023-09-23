@extends('template')
@section('content-logged-in')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Pacientes</h1>
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
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Editar | Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>11</td>
                            <td>Samuel Martinez Lopez</td>
                            <td>3168310691503</td>
                            <td>samuelmartinez@gmail.com</td>
                            <td>12345678</td>
                            <td>
                                <button class="btn btn-success" title="Editar Registro">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger" title="Eliminar Registro">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
