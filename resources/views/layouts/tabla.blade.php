@foreach ($horarios as $horario)

    <tr>
        <td>{{ $horario->clave_materia }}</td>
        <td class="hidden-mobile">{{ $horario->nombre_materia }}</td>
        <td class="hidden-mobile">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }} hrs</td>
        <td class="hidden-mobile">{{ $horario->aula }}</td>
        <td class="hidden-on-desktop">{{ $horario->aula }} <br>{{ $horario->hora_inicio }} {{ $horario->hora_fin }}</td>
        <td>{{ $horario->nombre }} {{ $horario->ap_paterno }} {{ $horario->ap_materno }} </td>

        <td>
            @if ($horario->asistencia == 'Presente' || $horario->asistencia == 'Retardo')
                <input type="hidden" name="asistencia[]" value="{{ $horario->asistencia }}">
            @endif
            <select class="form-control select" aria-label="Default select example" name="asistencia[]"
                @if ($horario->asistencia == 'Presente' || $horario->asistencia == 'Retardo') disabled @endif>
                <option value="Seleccione" @if (is_null($horario->asistencia)) selected @endif>Seleccione</option>
                <option value="Presente" @if ($horario->asistencia === 'Presente') selected @endif
                    @if ($horario->asistencia === 'Falta') disabled @endif>Presente</option>
                <option value="Retardo" @if ($horario->asistencia === 'Retardo') selected @endif>Retardo</option>
                <option value="Falta" @if ($horario->asistencia === 'Falta') selected @endif>Falta</option>
            </select>
        </td>
        <td>

            <div class="container-fluid">
                <div class="modal fade" id="miModal{{$horario->clave_materia}}{{$horario->letra_grupo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <form action="{{ route('agregarObservacion') }}" method="POST" id="formObservacion{{$horario->clave_materia}}{{$horario->letra_grupo}}">
                                    @csrf
                                    <p><i class="fa-solid fa-school"></i> {{ $horario->aula }}&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-clock"></i> {{ $horario->hora_inicio }}-{{ $horario->hora_fin }}</p>
                                    <p><i class="fa-solid fa-chalkboard-user"></i> &nbsp; {{ $horario->nombre }} {{ $horario->ap_paterno }} {{ $horario->ap_materno }}</p>
                                    <textarea class="form-control" id="FormObservacion" name="observacion" rows="3">{{ $horario->observacion }}</textarea>
                                    <input type="hidden" name="horarios" value="{{ json_encode($horario) }}">
                                </form>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" form="formObservacion{{$horario->clave_materia}}{{$horario->letra_grupo}}">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="text-center">
                <button class="btn btn-warning" id="observacion" type="button" data-toggle="modal"
                    data-target="#miModal{{$horario->clave_materia}}{{$horario->letra_grupo}}" data-materia="{{ $horario->nombre_materia }}"
                    @if (is_null($horario->asistencia)) disabled @endif>
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </td>
    </tr>
@endforeach

<input type="hidden" name="horarios" value="{{ json_encode($horarios) }}">

@if ($mensaje)
    <tr >
        <td colspan="7">
        <div id="message-message" class="alert alert-warning">
            {{ $mensaje }}
        </div>
        </td>
    </tr>
@endif
