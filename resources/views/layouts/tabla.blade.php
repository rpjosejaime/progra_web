@foreach ($horarios as $horario)
    <!-- <tr data-id="{{ $horario->clave_materia }}{{ $horario->aula }}"> -->
    <tr>
        <td>{{ $horario->clave_materia }}</td>
        <td class="hidden-mobile">{{ $horario->nombre_materia }}</td>
        <td class="hidden-mobile">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }} hrs</td>
        <td>{{ $horario->aula }}</td>
        <td>{{ $horario->nombre }} {{ $horario->ap_paterno }} {{ $horario->ap_materno }} </td>
        <td hidden>{{ $horario->clave_plan_estudios }}</td>
        <td hidden>{{ $horario->periodo }}</td>
        <td>
            @if ($horario->asistencia == 'Presente' || $horario->asistencia == 'Retardo')
                <input type="hidden" name="asistencia[]" value="{{ $horario->asistencia }}">
            @endif
            <select class="form-control select" aria-label="Default select example" name="asistencia[]"
                 @if ($horario->asistencia == 'Presente' || $horario->asistencia == 'Retardo' ) disabled @endif >
                <option value="Seleccione" @if (is_null($horario->asistencia)) selected @endif>Seleccione</option>
                <option value="Presente" @if ($horario->asistencia === 'Presente') selected @endif @if ($horario->asistencia === 'Falta') disabled @endif>Presente</option>
                <option value="Retardo" @if ($horario->asistencia === 'Retardo') selected @endif>Retardo</option>
                <option value="Falta" @if ($horario->asistencia === 'Falta') selected @endif>Falta</option>
            </select>
        </td>
    </tr>
@endforeach

<input type="hidden" name="horarios" value="{{ json_encode($horarios) }}">
