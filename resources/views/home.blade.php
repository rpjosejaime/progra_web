@extends('layouts.plantilla')

@section('content')
    <div class="card">
        <div class="card-header">Panel Principal</div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="text-center card-body">
                            <p class="card-text"> {{ $nombre }} </p>
                            <img src="/img/profile.png" width="80px" height="80px" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                    </div>
                </div>
                <!--if vaidarRoles-->
                <!--if vaidarRoles-->
                <div class="col-sm-4 ">
                </div>
                <!--if sub 14-->
                <!--if vaidarRoles-->
                <!--if vaidarRoles-->
                <!--if vaidarRoles-->
                <div class="col-sm-4 ">
                    <div class="card">
                        <div class="card-body">
                            <h5 class=""><i class="fas fa-check"></i>
                                Asistencia Docente
                            </h5>
                            <p class="card-text">Ingresa para iniciar el recorrido y confirmar asistencia.
                            </p>
                            <a href="https://cetech.sjuanrio.tecnm.mx/docente/list_nivel_academico"
                                class="btn btn-primary">Acceder
                                <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!--if sub 14-->
                <!--if vaidarRoles-->
                <!--if vaidarRoles-->
                <div class="col-sm-4 ">
                </div>

            </div>
        </div>
    </div>
@endsection
