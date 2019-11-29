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
            <h1>Editar Comentario</h1>
            <form action="{{ url('comment/' . $comment->id) }}" method="post" class="form" id="form">
                @csrf
                @method('PUT')
                <div class="form-input-container">
                    <label for="content">Contenido</label>
                    <textarea name="content" id="content" placeholder="Cotenido Comentario" class="form-input">{{ old('content', $comment->content) }}</textarea>
                </div>
                <input type="submit" value="Editar Comentario" id="form-button" class="form-button">
            </form>
            <a href="{{ url('post') }}" class='btn btn-info'>Cancelar</a>
        </div>        
    </div>
</div>

@stop