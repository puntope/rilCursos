@extends('layouts.pagina')

@section('header')
    @parent

    <title>Inscripcion {{ $categoria->nombre }}</title>

@stop


@section('pagina')

    <div class="container">
        <h3 class="text-center">Inscripcion al curso: {{ $categoria->nombre }} <small>{{ $curso->horario }}</small></h3><br>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <h3>{{ $curso->resumen }}</h3>
                        <p>{{ $curso->descripcion }}</p>
                        <p>{{ $curso->fechaInicio." ".$curso->duracion }}</p>
                        <blockquote>
                            {{ $curso->lugar }}
                        </blockquote>
                        <p>{{ $curso->precios }}</p>
                        <p>{{ $profesor->nombre." ".$profesor->apellidos }}</p>
                        @if(Storage::disk('local')->has('curso-'.$curso->slug.'.jpg'))
                            <img src="{{ route('curso.imagen', ['filename' => 'curso-'.$curso->slug.'.jpg']) }}" class="img-responsive" />
                        @endif
                        <a href="/pagar/{{ $curso->slug }}" class="btn btn-primary">Pagar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="vacio"></div>

    </div>

@stop

@section('footer')
    @parent

@stop