@extends('template')
@section('content-logged-in')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Oficinas</h1>
        </section>
        <section class="content">
            <div class="box">
                <br>
                <form method="post">
                    @csrf
                    <div class="col-md-6 col-xs-12">
                        <input type="text" class="form-control" name="office" id="office" placeholder="Digita Nuevo Consultorio" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Add Office</button>
                </form>
                <br>
                <div class="box-body">
                    @foreach ($offices as $office)
                        <div class="row">
                            <form action="{{ url('Office/' . $office -> id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="officeEdit" id="officeEdit" value="{{ $office -> office }}">
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-success" type="submit">Update</button>
                                </div>
                            </form>
                            <div class="col-md-1">
                                <form action="{{ url('Office/' . $office -> id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
