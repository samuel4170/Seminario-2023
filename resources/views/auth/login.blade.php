@extends('template')
@section('content')

<div class="login-box">
    <div class="login-logo">
        <b>CITAGRO</b>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Ingresar al Sistema</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" required value="">
                @error('email')
                    <br>
                    <div class="alert alert-danger">Error al iniciar sesión</div>
                @enderror
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" required value="">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">INGRESAR</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
