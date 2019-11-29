@extends('index')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="pokemon-form">
    <div class="container">
        <div class="form-container">
            <h1>Añadir Comentario</h1>
            <form action="{{ url('comment?idpost=' . $idpost) }}" method="post" class="form" id="form">
                @csrf
                <div class="form-input-container">
                    <label for="content">Contenido</label>
                    <textarea name="content" id="content" placeholder="Cotenido Comentario" class="form-input">{{ old('content') }}</textarea>
                </div>
                <input type="submit" value="Crear Comentario" id="form-button" class="form-button">
            </form>
            <a href="{{ url('post') }}" class='btn btn-info'>Cancelar</a>
        </div>        
    </div>
</div>

@stop