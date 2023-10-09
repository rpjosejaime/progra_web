@extends('layouts.plantilla')

@section('content')
    <script>
        // Función para obtener y mostrar la hora actual
        function mostrarHoraActual() {
            const horaActual = new Date();
            const hora = horaActual.getHours();
            const minutos = horaActual.getMinutes();
            const segundos = horaActual.getSeconds();

            const horaFormateada = `${hora}:${minutos}:${segundos}`;
            document.getElementById('hora-actual').textContent = horaFormateada;
        }

        // Actualizar la hora cada segundo (1000 milisegundos)
        setInterval(mostrarHoraActual, 1000);

        // Mostrar la hora al cargar la página
        window.onload = mostrarHoraActual;
    </script>

    <h3 class="text-center">Pase de asistencia</h3>
    <h5 class="text-center">Hora de recorrido <span id="hora-actual"></span></h5>

    <div class="options">
        <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Edificio
            </button>
            <div class="dropdown-menu">
                @foreach ($edificios as $edificio)
                    <a class="dropdown-item" href="#"
                        data-edificio="{{ $edificio->edificio }}">{{ $edificio->edificio }}</a>
                @endforeach
            </div>
        </div>
        <!-- <div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Salón
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">E</a>
                    <a class="dropdown-item" href="#">F</a>
                    <a class="dropdown-item" href="#">M</a>
                </div>
            </div> -->
    </div>

    <table class="table table-striped mt-2">

        <thead>
            <tr>
                <th class="hidden-mobile">Clave</th>
                <th>Materia</th>
                <th class="hidden-mobile">Horario</th>
                <th>Aula</th>
                <th>Docente</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody id="horarios-table">

            @foreach ($horarios as $horario)
                <tr>
                    <td>{{ $horario->clave_materia }}</td>
                    <td class="hidden-mobile">{{ $horario->nombre_materia }}</td>
                    <td class="hidden-mobile">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }} hrs</td>
                    <td>{{ $horario->aula }}</td>
                    <td>{{ $horario->nombre }} {{ $horario->ap_paterno }} {{ $horario->ap_materno }} </td>
                    <td>Opciones</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-item').click(function(e) {
                e.preventDefault();
                var edificio = $(this).data('edificio');
                $.ajax({
                    type: 'GET',
                    url: '/prefectura/asistencia_edificio', // Reemplaza con la URL de tu controlador
                    data: {
                        edificio: edificio
                    },
                    success: function(data) {
                        $('#horarios-table').html(data);
                    }
                });
            });
        });
    </script>
@endsection
