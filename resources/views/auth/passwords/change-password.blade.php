@extends('layouts.plantilla')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header"><b>Cambiar Contrase&ntilde;a</b></div>
                                <div class="card-body">
                                    @if ($errors->has('current_password'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('current_password') }}
                                        </div>
                                    @endif
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('cambiar-contrasena.post') }}">
                                        @csrf

                                        <!-- Campo para la contraseña actual -->
                                        <div>
                                            <label for="current_password">Contraseña Actual</label>
                                            <input type="password" class="form-control" id="current_password"
                                                name="current_password" required autofocus>
                                        </div>

                                        <!-- Campo para la nueva contraseña -->
                                        <div>
                                            <br>
                                            <label for="new_password">Nueva Contraseña</label>
                                            <input type="password" class="form-control" id="new_password"
                                                name="new_password" required>
                                        </div>

                                        <!-- Confirmación de la nueva contraseña -->
                                        <div>
                                            <br>
                                            <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation" required>
                                        </div>

                                        <div>
                                            <br>
                                            <a href="{{ route('home') }}" class="btn btn-default"><i
                                                    class="fas fa-arrow-left"></i>
                                                Regresar</a>
                                            <button type="submit" class="btn btn-primary float-right"> <i
                                                    class="fa fa-save"></i> Cambiar Contraseña</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
