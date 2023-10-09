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
