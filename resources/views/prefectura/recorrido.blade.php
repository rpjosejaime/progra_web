@extends('layouts.plantilla')

@section('content')
    <script type="application/javascript">
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
    @if (session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="options">
        <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Edificio
            </button>
            <div id="edificioDropdown" class="dropdown-menu">
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
    <form action="{{ route('guardarAsistencia') }}" method="POST">
        @csrf
        <table id='tabla_horario' class="table table-striped mt-2">

            <thead>
                <tr>
                    <th class="hidden-mobile">Clave</th>
                    <th>Materia</th>
                    <th class="hidden-mobile">Horario</th>
                    <th>Aula</th>
                    <th>Docente</th>
                    <th>Asistencia</th>
                    <th hidden>Plan Estudios</th>
                    <th hidden>Periodo</th>
                </tr>
            </thead>
            <tbody id="horarios-table">
                @include('layouts.tabla', ['horarios' => $horarios])
            </tbody>
        </table>


        <div class="float-right">
            <div class="float-right">
                <button class="btn btn-success" id="guardar-button" type="submit">
                    <i class="fas fa-arrow-circle-up"></i> Registrar
                </button>
            </div>
        </div>
    </form>

    <br><br><br><br>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="application/javascript"></script>
    <script type="application/javascript">
        $(document).ready(function() {
            $('#edificioDropdown .dropdown-item').click(function(e) {
                e.preventDefault();
                var edificio = $(this).data('edificio');
                $.ajax({
                    type: 'GET',
                    url: '/prefectura/asistencia_edificio', // Reemplaza con la URL de tu controlador
                    data: {
                        edificio: edificio
                    },
                    success: function(data) {
                        var successMessage = document.getElementById('success-message');
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                        $('#horarios-table').html(data);
                    }
                });
            });
        });
    </script>
    <script type="application/javascript">
        $(document).ready(function () {
            $('#guardar-button').off('click').on('click', function () {
            //$('#guardar-button').click(function () {
                var isValid = true;

                // Itera a través de todos los selects con name="asistencia"
                $('select[name="asistencia[]"]').each(function () {
                    if ($(this).val() === 'Seleccione') {
                        isValid = false;
                        alert('Por favor, seleccione una opción para todas las filas.');
                        return false; // Sale del bucle cuando encuentra una opción no seleccionada
                    }
                });

                // Si todos los selects tienen opciones seleccionadas, envía el formulario
                if (isValid) {
                    $('form').submit();
                }else{
                    return false;
                }


            });
        });
    </script>
@endsection
