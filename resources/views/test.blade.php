@extends('layouts.plantilla')

@section('content')
    <h1> Listado </h1>
    <ul>
        @foreach ($grupos as $grupo)
            <li> {{ $grupo->clave_materia }}
        @endforeach
    </ul>
    {{$grupos->links()}}
@endsection
