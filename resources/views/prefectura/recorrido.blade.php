@extends('layouts.plantilla')

@section('content')
    <script type="application/javascript">
        // Función para obtener y mostrar la hora actual
        function mostrarHoraActual() {
            const horaActual = new Date();
            const hora = horaActual.getHours();
            //const minutos = horaActual.getMinutes();
            //const segundos = horaActual.getSeconds();
            const minutos = horaActual.getMinutes().toString().padStart(2, '0');
            const segundos = horaActual.getSeconds().toString().padStart(2, '0');


            const horaFormateada = `${hora}:${minutos}:${segundos}`;
            document.getElementById('hora-actual').textContent = horaFormateada;
        }

        // Actualizar la hora cada segundo (1000 milisegundos)
        setInterval(mostrarHoraActual, 1000);

        // Mostrar la hora al cargar la página
        window.onload = mostrarHoraActual;
    </script>
    <div class="container-fluid">
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
                    Seleccionar edificio
                </button>
                <div id="edificioDropdown" class="dropdown-menu">
                    @foreach ($edificios as $edificio)
                        <a class="dropdown-item" href="#"
                            data-edificio="{{ $edificio->edificio }}">{{ $edificio->edificio }}</a>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="tabla-contenedor">
            <div class="col-md-12">
                <form action="{{ route('guardarAsistencia') }}" method="POST">
                    @csrf
                    <table id='tabla_horario' class="table table-striped mt-2">

                        <thead>
                            <tr>
                                <th class="hidden-mobile">Clave</th>
                                <th>Materia</th>
                                <th class="hidden-mobile">Horario</th>
                                <th class="hidden-mobile">Aula</th>
                                <th class="hidden-on-desktop">Aula/Hr</th>
                                <th>Docente</th>
                                <th>Asistencia</th>
                                <th>Observación</th>
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
            </div>
            {{-- <div class="col-md-2">
            <table id='tabla_horario' class="table">

                <thead>
                    <tr>

                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody id="hor">
                    <td>
                        <div class="text-center">
                            <button class="btn btn-warning" id="observacion">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tbody>
            </table>
        </div> --}}
        </div>
    </div>

    <!-- Modal -->
    <div class="container-fluid">
        <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Observación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí coloca tu formulario -->
                        <!-- Por ejemplo, puedes incluir un formulario de Laravel Blade -->

                        <textarea class="form-control" id="FormObservacion" rows="3"></textarea>
                        <p>Nombre de la materia: <span id="nombreMateriaEnModal"></span></p>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        console.log('Falta pasar asistencia');
                        alert('Por favor, debe pasar asistencia en todo el edificio.');
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
    <script type="application/javascript" >
    document.addEventListener("DOMContentLoaded", function() {
        $('#miModal').on('show.bs.modal', function(event) {
            console.log('Valor de materia:', materia);
            var button = $(event.relatedTarget); // Botón que abrió el modal
            var materia = button.data('materia'); // Obtén el valor del atributo data-materia
            // Asigna el valor al textarea
            $('#FormObservacion').val(materia);
        });
    });
    </script>
@endsection
