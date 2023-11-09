@extends('layouts.plantilla')

@section('content')
    <div class="container-fluid">
        <h3 class="text-center">Reportes de asistencia docente</h3>
        <h5 class="text-center">Para ver el reporte de un docente, seleccione el área académica<span id="hora-actual"></span>
        </h5>
        <div class="options">
            <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Seleccionar Área Académica
                </button>
                <div id="areaDropdown" class="dropdown-menu">
                    @foreach ($areas as $area)
                        <a class="dropdown-item" href="#"
                            data-area="{{ $area->clave_area }}">{{ $area->descripcion_area }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="tabla-contenedor">
            <div class="col-md-12">
                <table id='tabla_listado' class="table table-striped mt-3">

                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Asistencias</th>
                            <th>Retardos</th>
                            <th>Faltas</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="listado-table">
                        <tr>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



    </div>
    <script type="application/javascript">
        $(document).ready(function () {
            $('#areaDropdown .dropdown-item').click(function (e) {
                e.preventDefault();
                var claveArea = $(this).data('area');
                actualizarTabla(claveArea);
            });
        });

        function actualizarTabla(claveArea) {
            // Realiza una solicitud AJAX para obtener los datos del servidor
            $.ajax({
                type: 'GET',
                url: '/prefectura/listado_docentes',
                data: { clave_area: claveArea },
                success: function (data) {
                    // Actualiza la tabla con los datos obtenidos del servidor
                    $('#listado-table').html(data);
                }
            });
        }
    </script>

@endsection
