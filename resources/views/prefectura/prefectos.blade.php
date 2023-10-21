@extends('layouts.plantilla')

@section('content')
    <h3 class="text-center p-3">Administración de Prefectos</h3>

    @if (session('Correcto'))
        <div class="alert alert-success">{{ session('Correcto') }}</div>
    @endif

    @if (session('Incorrecto'))
        <div class="alert alert-danger">{{ session('Incorrecto') }}</div>
    @endif

    <script type="application/javascript">
        var res = function() {
            var not = confirm("¿Estas seguro de eliminar?");
            return not;
        }
    </script>


    <!-- Modal de registro de datos -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Añadir Prefecto</h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-circle-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('createUser') }}" method="GET" id="formCreate">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="txtrfc">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="txtnombre">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="txtapepaterno">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="txtapematerno">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="txtemail">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="txtpassword">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" form="formCreate">Añadir</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="p-2 table-responsive">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar"><i class="fa-solid fa-user-plus"></i> Añadir Prefecto</button>
        <div style="margin-top: 10px;"></div>
        <table class="table table-striped table-bordered table-hover">
            <thead style="background-color: #24547a; color: white;">
                <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
                </script>

                <tr>
                    <th scope="col">RFC</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>
                    <th scope="col">Email</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>

                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos as $item)
                    <tr>
                        <td>{{ $item->RFC }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->ap_paterno }}</td>
                        <td>{{ $item->ap_materno }}</td>
                        <td>{{ $item->email }}</td>

                        <td>
                            <div style="text-align: center;"> <a href="" data-bs-toggle="modal" data-bs-target="#Modaleditar{{ $item->RFC }}"
                                class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> </div>
                        </td>
                        <td>
                            <div style="text-align: center;"> <a href="{{ route('crud.delete', $item->RFC) }}" onclick="return res()"
                                class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"
                                    style="color: #050505;"></i></a></div>


                        <!-- Modalde modificar datos -->

                        <div class="modal fade" id="Modaleditar{{$item->RFC}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel{{$item->RFC}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-3" id="exampleModalLabel">Modificar prefecto</h3>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close"><i class="fa-solid fa-circle-xmark"></i></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('crud.update', $item->RFC) }}" method="GET"
                                            id="form{{$item->RFC}}">
                                            @csrf
                                            @method('GET')

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">RFC</label>
                                                <input type="text" class="form-control" id="txtRFC" name="txtRFC"
                                                    value="{{ $item->RFC }} " readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">nombre</label>
                                                <input type="text" class="form-control" id="txtnombre" name="txtnombre"
                                                    value="{{ $item->nombre }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Apellido
                                                    Paterno</label>
                                                <input type="text" class="form-control" id="txtap_paterno"
                                                    name="txtap_paterno"value="{{ $item->ap_paterno }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Apellido
                                                    Materno</label>
                                                <input type="text" class="form-control" id="txtap_materno"
                                                    name="txtap_materno"value="{{ $item->ap_materno }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="txtEmail"
                                                    aria-describedby="emailHelp" name="txtEmail"
                                                    value="{{ $item->email }}">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary"
                                                    form="form{{$item->RFC}}">Modificar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
